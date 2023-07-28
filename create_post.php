<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['category_id']) && isset($_POST['title']) && isset($_POST['user']) && isset($_POST['content'])) {
        require_once 'database.php';
        $category_id = $_POST['category_id'];
        $title = $_POST['title'];
        $user = $_POST['user'];
        $content = $_POST['content'];
        save_post($category_id, $title, $user, $content);
        header('Location: index.php?success=1');
        exit;
    } else {
        header('Location: create_post.php?error=1');
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a New Post - DComment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header class="bg-primary text-white p-3">
        <div class="container">
            <h1>DComment</h1>
        </div>
    </header>

    <main class="container mt-4">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h2>Create a New Post</h2>
            </div>
            <div class="card-body">
                <?php
                if (isset($_GET['error']) && $_GET['error'] == 1) {
                    echo '<p style="color: red;">Please fill out all fields to create a post.</p>';
                }
                ?>
                <form method="post" action="create_post.php">
                    <div class="form-group">
                        <label for="category_id">Category:</label>
                        <select class="form-control" name="category_id" id="category_id">
                            <?php
                            require_once 'database.php';
                            $categories = fetch_categories();

                            foreach ($categories as $category) {
                                echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" name="title" id="title" required>
                    </div>
                    <div class="form-group">
                        <label for="user">User:</label>
                        <input type="text" class="form-control" name="user" id="user" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Content:</label>
                        <textarea class="form-control" name="content" id="content" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Post</button>
                </form>
            </div>
        </div>
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
