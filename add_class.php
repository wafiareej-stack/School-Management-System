<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add'])) {
    $class_name = $_POST['class_name'];

    // إدخال البيانات في جدول classes
    $sql = "INSERT INTO classes (class_name) VALUES ('$class_name')";

    if (mysqli_query($conn, $sql)) {
        header("Location: view_classes.php");
    } else {
        echo "خطأ في الإضافة: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة فصل جديد</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 500px;">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">إضافة فصل دراسي</h3>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">اسم الفصل أو الشعبة</label>
                <input type="text" name="class_name" class="form-control" placeholder="مثلاً: الصف الأول، الشعبة أ" required>
            </div>
            <button type="submit" name="add" class="btn btn-warning text-white w-100">حفظ الفصل</button>
            <a href="view_classes.php" class="btn btn-link w-100 mt-2 text-decoration-none text-secondary">إلغاء</a>
        </form>
    </div>
</div>

</body>
</html>