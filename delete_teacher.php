<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // حذف المعلم باستخدام teacher_id من قاعدة البيانات
    $sql = "DELETE FROM teachers WHERE teacher_id = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location: view_teachers.php");
    } else {
        echo "خطأ في الحذف: " . mysqli_error($conn);
    }
}
?>