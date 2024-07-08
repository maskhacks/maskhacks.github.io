<?php
$posts = json_decode(file_get_contents('admin/posts.json'), true);
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>وب‌سایت</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="content">
        <h1>MASK HACK</h1>
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <h2><?= htmlspecialchars($post['title']) ?></h2>
                <img src="admin/posts/<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>">
                <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>