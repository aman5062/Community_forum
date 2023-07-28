<?php
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid category ID.";
    exit;
}
$category_id = $_GET['id'];
require_once 'database.php';
$category = fetch_category_by_id($category_id);
if (!$category) {
    echo "Category not found.";
    exit;
}
$posts = fetch_posts_by_category($category_id);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $category['name']; ?> - DComment</title>
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
            font-size: 20px;
            font-weight: bold;
        }
        .post-author {
            font-size: 14px;
            color: #888;
        }
        .post-item {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <header>
        <h1>DComment</h1>
    </header>
    <main>
        <h2>Category: <?php echo $category['name']; ?></h2>
        <?php if ($posts && count($posts) > 0) : ?>
            <?php foreach ($posts as $post) : ?>
                <div class="post-item">
                    <h3 class="post-title"><a href="post.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h3>
                    <p class="post-author">Posted by <?php echo $post['user']; ?></p>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No posts found for this category.</p>
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
