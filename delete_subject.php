<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM subjects WHERE subject_id = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location: view_subjects.php");
    } else {
        echo "خطأ في الحذف: " . mysqli_error($conn);
    }
}
?>