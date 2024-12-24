<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../includes/header.php');

$blog_folder = '../data/blogs/';
$blog_file = $_GET['blog'] ?? null;

// Sanitize the blog file name
$blog_file = basename($blog_file);

if ($blog_file && file_exists($blog_folder . $blog_file)) {
    $blog_path = $blog_folder . $blog_file;
} else {
    die('Blog not found.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - <?php echo htmlspecialchars($blog_file); ?></title>
    <link rel="stylesheet" href="../assets/css/blog.css">
</head>
<body>

<header>
    <div class="blog-header">
        <h1><?php echo htmlspecialchars(basename($blog_file, '.html')); ?></h1>
        <a href="blogs.php" class="back-link">← Back to Blogs</a>
    </div>
</header>

<main class="blog-full-content">
    <?php include($blog_path); ?>
</main>

<?php include('../includes/footer.php'); ?>

</body>
</html>
