<?php
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid post ID.";
    exit;
}
$post_id = $_GET['id'];
require_once 'database.php';
$post = fetch_post_by_id($post_id);
if (!$post) {
    echo "Post not found.";
    exit;
}
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $post['title']; ?> - DComment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 20px;
        }
        header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        main {
            padding: 20px;
        }
        .post-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .post-meta {
            font-size: 16px;
            color: #888;
            margin-bottom: 20px;
        }
        .post-content {
            font-size: 18px;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <header>
        <h1>DComment</h1>
    </header>
    <main class="container">
        <?php if ($post) : ?>
            <div class="post-details">
                <h2 class="post-title"><?php echo $post['title']; ?></h2>
                <p class="post-meta">Posted by <?php echo $post['user']; ?></p>
                <p class="post-content"><?php echo nl2br($post['content']); ?></p>
            </div>
        <?php else : ?>
            <p>No post found.</p>
        <?php endif; ?>
    </main>
    <footer>
        <div class="container text-center mt-4">
            <p>&copy; <?php echo date('Y'); ?> DComment. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
