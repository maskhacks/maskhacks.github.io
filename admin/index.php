<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}

$posts = json_decode(file_get_contents('posts.json'), true);
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>پنل ادمین</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="admin-panel">
        <nav>
            <ul>
                <li><a href="index.php">مدیریت مطالب</a></li>
                <li><a href="new_post.php">ارسال مطلب جدید</a></li>
            </ul>
        </nav>
        <main>
            <h1>مدیریت مطالب</h1>
            <table>
                <tr>
                    <th>عنوان</th>
                    <th>عملیات</th>
                </tr>
                <?php foreach ($posts as $id => $post): ?>
                    <tr>
                        <td><?= htmlspecialchars($post['title']) ?></td>
                        <td><a href="edit_post.php?id=<?= $id ?>">ویرایش</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </main>
    </div>
</body>
</html>