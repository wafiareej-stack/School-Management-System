<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add'])) {
    $subject_name = $_POST['subject_name'];

    // إدخال المادة في الجدول
    $sql = "INSERT INTO subjects (subject_name) VALUES ('$subject_name')";

    if (mysqli_query($conn, $sql)) {
        header("Location: view_subjects.php");
    } else {
        echo "خطأ في الإضافة: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة مادة</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 500px;">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">إضافة مادة دراسية</h3>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">اسم المادة</label>
                <input type="text" name="subject_name" class="form-control" placeholder="مثلاً: لغة عربية، تكنولوجيا" required>
            </div>
            <button type="submit" name="add" class="btn btn-primary w-100">حفظ المادة</button>
            <a href="view_subjects.php" class="btn btn-link w-100 mt-2 text-decoration-none text-secondary">إلغاء</a>
        </form>
    </div>
</div>

</body>
</html>