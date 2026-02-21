<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect & sanitize data
    $first_name     = trim($_POST['first_name']);
    $last_name      = trim($_POST['last_name']);
    $course         = trim($_POST['course']);
    $dob            = trim($_POST['dob']);
    $age            = trim($_POST['age']);
    $gender         = trim($_POST['gender']);
    $guardian_name  = trim($_POST['guardian_name']);
    $phone          = trim($_POST['phone']);
    $address        = trim($_POST['address']);
    $aadhaar        = trim($_POST['aadhaar']);
    $state          = trim($_POST['state']);
    $district       = trim($_POST['district']);
    $pin            = trim($_POST['pin']);

    $student_name = $first_name . " " . $last_name;

    // ================= IMAGE UPLOAD =================
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

        $image_name = $_FILES['image']['name'];
        $image_tmp  = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];

        $allowed_ext = ['jpg','jpeg','png','webp'];
        $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

        if(!in_array($ext, $allowed_ext)) {
            die("Only JPG, JPEG, PNG, WEBP files allowed.");
        }

        if($image_size > 2 * 1024 * 1024) {
            die("Image size must be less than 2MB.");
        }

        if(!is_dir("uploads")) {
            mkdir("uploads", 0777, true);
        }

        $new_image_name = time() . "_" . rand(1000,9999) . "." . $ext;
        $upload_path = "uploads/" . $new_image_name;

        move_uploaded_file($image_tmp, $upload_path);

    } else {
        die("Image upload failed.");
    }

    // ================= INSERT DATA =================
    $stmt = $conn->prepare("INSERT INTO students 
    (student_name, dob, age, course, gender, guardian_name, phone, address, aadhaar, state, district, pin, image) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "ssissssssssss",
        $student_name,
        $dob,
        $age,
        $course,
        $gender,
        $guardian_name,
        $phone,
        $address,
        $aadhaar,
        $state,
        $district,
        $pin,
        $upload_path
    );

    if($stmt->execute()) {

        $last_id = $stmt->insert_id;
        $current_year = date("Y");

        // Smart Student ID
        $formatted_number = str_pad($last_id, 3, "0", STR_PAD_LEFT);
        $student_id = "YWA-" . $current_year . "-" . $formatted_number;

        // Update student_id
        $update = $conn->prepare("UPDATE students SET student_id=? WHERE id=?");
        $update->bind_param("si", $student_id, $last_id);
        $update->execute();

        // ================= WHATSAPP NOTIFICATION =================
        $whatsapp_number = "919382397268"; // Change your number

        $message = urlencode(
            "New Admission - Youth Warriors Academy\n\n" .
            "Student ID: $student_id\n" .
            "Name: $student_name\n" .
            "Course: $course\n" .
            "Phone: $phone"
        );

        $whatsapp_url = "https://wa.me/$whatsapp_number?text=$message";

        header("Location: admission_success.php?student_id=$student_id");
        exit();

    } else {
        echo "Database Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>