<?php
include 'db.php';
session_start();

// حماية الصفحة: التأكد من تسجيل الدخول
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// جلب المواد من جدول subjects
$query = "SELECT * FROM subjects";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة المواد الدراسية</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>قائمة المواد الدراسية</h2>
        <div>
            <a href="add_subject.php" class="btn btn-primary">إضافة مادة جديدة +</a>
            <a href="dashboard.php" class="btn btn-secondary">العودة للرئيسية</a>
        </div>
    </div>

    <div class="card shadow p-4">
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>اسم المادة</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>".$row['subject_id']."</td>
                                <td>".$row['subject_name']."</td>
                                <td>
                                    <a href='delete_subject.php?id=".$row['subject_id']."' class='btn btn-sm btn-danger' onclick='return confirm(\"هل أنتِ متأكدة من حذف هذه المادة؟\")'>حذف</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>لا يوجد مواد دراسية مضافة حالياً</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>