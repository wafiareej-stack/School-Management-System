<?php
include 'db.php';
session_start();

// حماية الصفحة
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// جلب بيانات الطلاب من قاعدة البيانات
$query = "SELECT * FROM students";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة الطلاب - نظام المدرسة</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>قائمة الطلاب</h2>
        <div>
            <a href="add_student.php" class="btn btn-success">إضافة طالب جديد +</a>
            <a href="dashboard.php" class="btn btn-secondary">العودة للرئيسية</a>
        </div>
    </div>

    <div class="card shadow p-4">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>الاسم الكامل</th>
                    <th>تاريخ الميلاد</th>
                    <th>الجنس</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>".$row['student_id']."</td>
                                <td>".$row['full_name']."</td>
                                <td>".$row['birth_date']."</td>
                                <td>".$row['gender']."</td>
                                <td>
                                    <a href='edit_student.php?id=".$row['student_id']."' class='btn btn-sm btn-warning'>تعديل</a>
                                    <a href='delete_student.php?id=".$row['student_id']."' class='btn btn-sm btn-danger' onclick='return confirm(\"هل أنت متأكد؟\")'>حذف</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>لا يوجد طلاب مضافين حالياً</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>