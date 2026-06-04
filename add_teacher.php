<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add'])) {
    $name = $_POST['full_name'];
    $spec = $_POST['specialization'];
    $email = $_POST['email'];

    // إدخال البيانات في جدول المعلمين
    $sql = "INSERT INTO teachers (full_name, specialization, email) VALUES ('$name', '$spec', '$email')";

    if (mysqli_query($conn, $sql)) {
        header("Location: view_teachers.php");
    } else {
        echo "خطأ في الإضافة: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة معلم جديد</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">إضافة معلم جديد</h3>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">الاسم الكامل</label>
                <input type="text" name="full_name" class="form-control" placeholder="أدخل اسم المعلم" required>
            </div>
            <div class="mb-3">
                <label class="form-label">التخصص</label>
                <input type="text" name="specialization" class="form-control" placeholder="مثلاً: رياضيات، برمجة" required>
            </div>
            <div class="mb-3">
                <label class="form-label">البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control" placeholder="example@mail.com" required>
            </div>
            <button type="submit" name="add" class="btn btn-success w-100">حفظ المعلم</button>
            <a href="view_teachers.php" class="btn btn-link w-100 mt-2 text-decoration-none text-secondary">إلغاء والعودة</a>
        </form>
    </div>
</div>

</body>
</html>