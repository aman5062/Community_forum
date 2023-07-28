<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DComment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header class="bg-primary text-white p-3">
        <div class="container">
            <h1>DComment</h1>
        </div>
    </header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light"> 
    </nav>
    <main class="container mt-4">
        <section id="categories">
            <h2>Categories</h2>
            <ul class="list-group">
                <?php
                require_once 'database.php';
                $categories = fetch_categories();
                foreach ($categories as $category) {
                    echo '<li class="list-group-item"><a href="category.php?id=' . $category['id'] . '">' . $category['name'] . '</a></li>';
                }
                ?>
            </ul>
        </section>
        <section id="latest-posts" class="mt-4">
            <h2>Latest Posts</h2>
            <ul class="list-group">
                <?php
                $latest_posts = fetch_latest_posts();
                foreach ($latest_posts as $post) {
                    echo '<li class="list-group-item">';
                    echo '<a href="post.php?id=' . $post['id'] . '">' . $post['title'] . '</a>';
                    echo '<p>Posted by ' . $post['user'] . '</p>';
                    echo '</li>';
                }
                ?>
            </ul>
        </section>
        <section id="new-post" class="mt-4">
            <a href="create_post.php" class="btn btn-primary">New Post</a>
        </section>
    </main>

    <footer class="bg-dark text-white p-3 mt-4">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> DComment. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
