<?php
$student_id = $_GET['student_id'] ?? '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admission Successful - Youth Warriors Academy</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body style="background:#f4f6f9;">

<div class="container mt-5">
    <div class="card shadow-lg text-center p-5">
        <h2 class="text-success">🥋 Admission Successful!</h2>
        <hr>
        <h4>Your Student ID:</h4>
        <h2 class="fw-bold text-primary"><?php echo htmlspecialchars($student_id); ?></h2>
        <p class="mt-3">Welcome to <strong>Youth Warriors Academy</strong></p>

        <a href="index.php" class="btn btn-dark mt-3">Back to Home</a>
        <a href="generate_id_card.php?student_id=<?php echo $student_id; ?>" class="btn btn-success mt-3">Download ID Card</a>
    </div>
</div>

</body>
</html>