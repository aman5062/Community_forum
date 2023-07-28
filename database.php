<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'community_forum';
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
function fetch_category_by_id($category_id) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM categories WHERE id = ?");
    $stmt->execute([$category_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function fetch_posts_by_category($category_id) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM posts WHERE category_id = ?");
    $stmt->execute([$category_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function fetch_post_by_id($post_id) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$post_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function save_post($category_id, $title, $user, $content) {
    global $db;
    try {
        $stmt = $db->prepare("INSERT INTO posts (category_id, title, user, content) VALUES (:category_id, :title, :user, :content)");
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':user', $user, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $e) {
        die("Error saving post: " . $e->getMessage());
    }
}
function fetch_categories() {
    global $db;
    $stmt = $db->prepare("SELECT * FROM categories");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function fetch_latest_posts() {
    global $db;
    $stmt = $db->query("SELECT * FROM posts ORDER BY id DESC LIMIT 5");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
