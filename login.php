<?php
include 'db.php'; // استدعاء ملف الربط الذي أنشأتِه
session_start(); // لبدء الجلسة وحفظ بيانات المستخدم

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // استعلام للتحقق من المستخدم
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $user_data['username'];
        $_SESSION['role'] = $user_data['role']; // حفظ الصلاحية (Admin أو Staff)
        
        header("Location: dashboard.php"); // التوجه للوحة التحكم عند النجاح
    } else {
        $error = "اسم المستخدم أو كلمة المرور غير صحيحة!";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول - نظام إدارة المدارس</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .login-container { margin-top: 100px; max-width: 400px; }
    </style>
</head>
<body>

<div class="container login-container shadow p-4 bg-white rounded">
    <h3 class="text-center mb-4">تسجيل الدخول</h3>
    
    <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label class="form-label">اسم المستخدم</label>
            <input type="text" name="username" class="form-control" required placeholder="أدخل اسم المستخدم">
        </div>
        <div class="mb-3">
            <label class="form-label">كلمة المرور</label>
            <input type="password" name="password" class="form-control" required placeholder="أدخل كلمة المرور">
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100">دخول</button>
    </form>
</div>

</body>
</html>