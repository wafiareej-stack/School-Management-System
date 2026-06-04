<?php
include 'db.php'; 
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// 1. جلب بيانات الطالب الحالي لعرضها في النموذج
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM students WHERE student_id = $id";
    $result = mysqli_query($conn, $query);
    $student = mysqli_fetch_assoc($result);
    
    if (!$student) {
        echo "الطالب غير موجود!";
        exit();
    }
} else {
    header("Location: view_students.php");
    exit();
}

// 2. تحديث البيانات عند الضغط على زر الحفظ
if (isset($_POST['update'])) {
    $name = $_POST['full_name'];
    $birth = $_POST['birth_date'];
    $gender = $_POST['gender'];

    $sql = "UPDATE students SET full_name='$name', birth_date='$birth', gender='$gender' WHERE student_id=$id";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: view_students.php"); // العودة للجدول بعد التعديل
    } else {
        echo "خطأ في التعديل: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل بيانات الطالب</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">تعديل بيانات الطالب</h3>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">الاسم الكامل</label>
                <input type="text" name="full_name" class="form-control" value="<?php echo $student['full_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">تاريخ الميلاد</label>
                <input type="date" name="birth_date" class="form-control" value="<?php echo $student['birth_date']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">الجنس</label>
                <select name="gender" class="form-select">
                    <option value="ذكر" <?php if($student['gender'] == 'ذكر') echo 'selected'; ?>>ذكر</option>
                    <option value="أنثى" <?php if($student['gender'] == 'أنثى') echo 'selected'; ?>>أنثى</option>
                </select>
            </div>
            <button type="submit" name="update" class="btn btn-warning w-100">تحديث البيانات</button>
            <a href="view_students.php" class="btn btn-link w-100 mt-2 text-decoration-none text-secondary">إلغاء والعودة</a>
        </form>
    </div>
</div>

</body>
</html>