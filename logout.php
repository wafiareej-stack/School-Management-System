<?php
session_start();
session_destroy(); // إنهاء الجلسة وحذف البيانات
header("Location: login.php"); // توجيه المستخدم لصفحة تسجيل الدخول
exit();
?>