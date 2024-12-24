<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../includes/header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Blogs</title>
    <link rel="stylesheet" href="../assets/css/blog.css">
</head>
<body>

<header>
    <div class="blog-header">
        <h1>Our Blogs</h1>
        <p>Explore our latest articles on technology, AI, and beyond!</p>
    </div>
</header>

<main class="blog-content">
    <?php
    $blog_folder = '../data/blogs/'; // Folder with blog files
    $blogs = array_diff(scandir($blog_folder), array('.', '..')); // Exclude '.' and '..' directories

    if (!empty($blogs)) {
        foreach ($blogs as $blog_file) {
            if (pathinfo($blog_file, PATHINFO_EXTENSION) == 'html') {
                // Extract blog summary and title dynamically
                $blog_path = $blog_folder . $blog_file;
                $blog_title = basename($blog_file, '.html');
                
                // Read a small portion of the content for summary
                $content = file_get_contents($blog_path);
                preg_match('/<p>(.*?)<\/p>/', $content, $matches);
                $summary = $matches[1] ?? 'No summary available.';

                echo '<div class="blog-summary">';
                echo "<h2>$blog_title</h2>";
                echo "<p>$summary...</p>";
                echo "<a href='view.php?blog=$blog_file' class='read-more'>Read More</a>";
                echo '</div>';
            }
        }
    } else {
        echo '<p>No blogs available. Please check back later!</p>';
    }
    ?>
</main>

<?php include('../includes/footer.php'); ?>

</body>
</html>
