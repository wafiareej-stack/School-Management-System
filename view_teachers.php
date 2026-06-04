<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// جلب بيانات المعلمين من الجدول
$query = "SELECT * FROM teachers";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة المعلمين</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>قائمة المعلمين</h2>
        <div>
            <a href="add_teacher.php" class="btn btn-success">إضافة معلم جديد +</a>
            <a href="dashboard.php" class="btn btn-secondary">العودة للرئيسية</a>
        </div>
    </div>

    <div class="card shadow p-4">
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>الاسم الكامل</th>
                    <th>التخصص</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>".$row['teacher_id']."</td>
                                <td>".$row['full_name']."</td>
                                <td>".$row['specialization']."</td>
                                <td>
                                    <a href='edit_teacher.php?id=".$row['teacher_id']."' class='btn btn-sm btn-warning'>تعديل</a>
                                    <a href='delete_teacher.php?id=".$row['teacher_id']."' class='btn btn-sm btn-danger' onclick='return confirm(\"هل أنت متأكد؟\")'>حذف</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>لا يوجد معلمون مضافون حالياً</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>