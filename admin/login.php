<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['logged_in'] = true;
        header('Location: index.php');
        exit;
    } else {
        $error = 'نام کاربری یا رمز عبور اشتباه است';
    }
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ورود به پنل ادمین</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="login-form">
        <form method="POST" action="login.php">
            <h2>ورود</h2>
            <input type="text" name="username" placeholder="نام کاربری" required>
            <input type="password" name="password" placeholder="رمز عبور" required>
            <button type="submit">ورود</button>
            <?php if (isset($error)): ?>
                <p class="error"><?= $error ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>