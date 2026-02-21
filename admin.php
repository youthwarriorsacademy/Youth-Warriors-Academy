<?php
include "config.php";
$result = $conn->query("SELECT * FROM students ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Youth Warriors Academy</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Student Admission List</h2>

    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>Student ID</th>
            <th>Name</th>
            <th>Course</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>

        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['student_id']; ?></td>
            <td><?php echo $row['student_name']; ?></td>
            <td><?php echo $row['course']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td>
                <a href="generate_id_card.php?student_id=<?php echo $row['student_id']; ?>" class="btn btn-sm btn-success">ID Card</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>