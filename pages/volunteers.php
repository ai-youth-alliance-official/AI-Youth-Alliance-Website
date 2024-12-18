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
    <title>Our Volunteers</title>
</head>
<body>

<header>
    <div class="volunteers-header">
        <h1>Our Volunteers</h1>
        <p>Meet the passionate individuals who contribute their time and skills to the AI Youth Alliance. Their efforts help make a difference in the world of AI.</p>
    </div>
</header>

<main class="volunteers-content">
    <?php
    $volunteers_folder = 'data/volunteers/';  // Folder where volunteer HTML files will be stored

    // Debugging: You can remove this line in production
    // echo '<p>Directory path: ' . realpath($volunteers_folder) . '</p>';

    // Check if the directory exists before scanning
    if (is_dir($volunteers_folder)) {
        $volunteers_files = array_diff(scandir($volunteers_folder), array('.', '..'));  // Get all files except '.' and '..'

        // Check if there are any files in the folder
        if (!empty($volunteers_files)) {
            foreach ($volunteers_files as $volunteers_file) {
                // Only include HTML files
                if (pathinfo($volunteers_file, PATHINFO_EXTENSION) == 'html') {
                    echo '<div class="volunteer-entry">';
                    include($volunteers_folder . $volunteers_file);  // Include the volunteer HTML file
                    echo '</div>';
                }
            }
        } else {
            echo '<p>No volunteers content available at the moment. Check back later!</p>';
        }
    } else {
        echo '<p>Upcominng</p>';
    }
    ?>
</main>

<?php include('../includes/footer.php'); ?>

</body>
</html>
