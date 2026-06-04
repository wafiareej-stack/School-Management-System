<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// جلب الفصول من جدول classes
$query = "SELECT * FROM classes";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة الفصول الدراسية</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>قائمة الفصول الدراسية</h2>
        <div>
            <a href="add_class.php" class="btn btn-warning text-white">إضافة فصل جديد +</a>
            <a href="dashboard.php" class="btn btn-secondary">العودة للرئيسية</a>
        </div>
    </div>

    <div class="card shadow p-4">
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>اسم الفصل / الشعبة</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>".$row['class_id']."</td>
                                <td>".$row['class_name']."</td>
                                <td>
                                    <a href='delete_class.php?id=".$row['class_id']."' class='btn btn-sm btn-danger' onclick='return confirm(\"هل أنتِ متأكدة من حذف هذا الفصل؟\")'>حذف</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>لا يوجد فصول مضافة حالياً</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>