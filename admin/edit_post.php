<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}

$posts = json_decode(file_get_contents('posts.json'), true);
$id = $_GET['id'];
$post = $posts[$id];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $post['image'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], 'posts/' . $image);
    }

    $posts[$id] = ['title' => $title, 'content' => $content, 'image' => $image];
    file_put_contents('posts.json', json_encode($posts));

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ویرایش مطلب</title>
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
            <h1>ویرایش مطلب</h1>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="عنوان" value="<?= htmlspecialchars($post['title']) ?>" required>
                <input type="file" name="image">
                <textarea name="content" placeholder="متن مطلب" required><?= htmlspecialchars($post['content']) ?></textarea>
                <button type="submit">ویرایش</button>
            </form>
        </main>
    </div>
</body>
</html>