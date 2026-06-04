<?php
session_start();
include 'db.php';

// حماية لوحة التحكم
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// جلب الإحصائيات من الـ 4 جداول الأساسية
$students_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM students");
$students_count = mysqli_fetch_assoc($students_query)['total'];

$teachers_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM teachers");
$teachers_count = mysqli_fetch_assoc($teachers_query)['total'];

$subjects_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM subjects");
$subjects_count = mysqli_fetch_assoc($subjects_query)['total'];

$classes_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM classes");
$classes_count = mysqli_fetch_assoc($classes_query)['total'];
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>نظام إدارة المدارس - لوحة التحكم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- شريط التنقل العلوي -->
<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container-fluid d-flex justify-content-between">
        <span class="navbar-brand mb-0 h1">نظام إدارة المدارس</span>
        <a href="logout.php" class="btn btn-outline-danger">تسجيل الخروج</a>
    </div>
</nav>

<div class="container">
    <!-- رسالة الترحيب -->
    <div class="alert alert-success shadow-sm mb-4">
        مرحباً بكِ يا <strong><?php echo $_SESSION['user']; ?></strong>! لقد سجلتِ الدخول بصلاحية الإدارة.
    </div>

    <!-- بطاقات التحكم والإحصائيات -->
    <div class="row g-4 text-center">
        <!-- بطاقة الطلاب -->
        <div class="col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary">إدارة الطلاب</h5>
                    <p class="card-text fs-4 mt-3">عدد الطلاب: <strong><?php echo $students_count; ?></strong></p>
                    <a href="view_students.php" class="btn btn-outline-primary btn-sm mt-2">عرض التفاصيل</a>
                </div>
            </div>
        </div>

        <!-- بطاقة المعلمين -->
        <div class="col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-success">إدارة المعلمين</h5>
                    <p class="card-text fs-4 mt-3">عدد المعلمين: <strong><?php echo $teachers_count; ?></strong></p>
                    <a href="view_teachers.php" class="btn btn-outline-success btn-sm mt-2">عرض التفاصيل</a>
                </div>
            </div>
        </div>

        <!-- بطاقة المواد -->
        <div class="col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-info">إدارة المواد</h5>
                    <p class="card-text fs-4 mt-3">عدد المواد: <strong><?php echo $subjects_count; ?></strong></p>
                    <a href="view_subjects.php" class="btn btn-outline-info btn-sm mt-2">عرض التفاصيل</a>
                </div>
            </div>
        </div>

        <!-- بطاقة الفصول -->
        <div class="col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-warning">إدارة الفصول</h5>
                    <p class="card-text fs-4 mt-3">عدد الفصول: <strong><?php echo $classes_count; ?></strong></p>
                    <a href="view_classes.php" class="btn btn-outline-warning btn-sm mt-2">عرض التفاصيل</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>