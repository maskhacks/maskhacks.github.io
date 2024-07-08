<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_FILES['image']['name'];

    move_uploaded_file($_FILES['image']['tmp_name'], 'posts/' . $image);

    $posts = json_decode(file_get_contents('posts.json'), true);
    $posts[] = ['title' => $title, 'content' => $content, 'image' => $image];
    file_put_contents('posts.json', json_encode($posts));

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ارسال مطلب جدید</title>
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
            <h1>ارسال مطلب جدید</h1>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="عنوان" required>
                <input type="file" name="image" required>
                <textarea name="content" placeholder="متن مطلب" required></textarea>
                <button type="submit">ارسال</button>
            </form>
        </main>
    </div>
</body>
</html>