<?php
include 'db.php';
session_start();

// حماية الصفحة
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // أمر الحذف من قاعدة البيانات
    $sql = "DELETE FROM students WHERE student_id = $id";

    if (mysqli_query($conn, $sql)) {
        // العودة لصفحة العرض بعد الحذف بنجاح
        header("Location: view_students.php");
    } else {
        echo "خطأ في الحذف: " . mysqli_error($conn);
    }
}
?>