<?php
// Define the directory where forum templates are stored
$forums_directory = '../data/forums/';

// Check if the forums directory exists and is accessible
if (is_dir($forums_directory)) {
    // Get a list of all forum templates, excluding '.' and '..'
    $forum_templates = array_diff(scandir($forums_directory), array('.', '..'));
} else {
    // Handle the case where the directory is missing or inaccessible
    $forum_templates = [];
    echo "<p>Error: Forums directory not found or inaccessible.</p>";
}

// Function to load and sanitize HTML file content
function loadForumContent($forum_file) {
    global $forums_directory;
    $file_path = $forums_directory . $forum_file;

    // Check if the file exists and is an HTML file
    if (file_exists($file_path) && pathinfo($file_path, PATHINFO_EXTENSION) === 'html') {
        return file_get_contents($file_path); // Return the raw content of the HTML file
    }
    return '<p>Forum content could not be loaded.</p>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Our Community Forums 🤝</title>
    <link rel="stylesheet" href="../assets/css/forum.css"> <!-- Link to your CSS -->
    <style>
        /* Add some basic styles for the forums */
        .forum-container {
            margin: 20px;
            padding: 20px;
        }
        .forum-template {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .forum-template h1 {
            color: #333;
        }
        .forum-template ul {
            list-style-type: square;
            padding-left: 20px;
        }
        .forum-template a {
            color: #007BFF;
            text-decoration: none;
        }
        .forum-template a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php include('../includes/header.php'); ?>

<main>
    <div class="forum-container">
        <h1>Explore Our Community Forums 🤝</h1>
        <p>Welcome to our community forum page. Explore the various events, workshops, and discussions below!</p>

        <!-- Display each forum template -->
        <?php
        if (!empty($forum_templates)) {
            foreach ($forum_templates as $template_file) {
                // Load the content of each forum file
                $forum_content = loadForumContent($template_file);

                // Output the content wrapped in a container
                echo '<div class="forum-template">';
                echo $forum_content; // Directly output the content of the HTML file
                echo '</div>';
            }
        } else {
            echo '<p>No forums available at the moment. Please check back later!</p>';
        }
        ?>
    </div>
</main>

<?php include('../includes/footer.php'); ?>

</body>
</html>
