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
    <title>Our Research</title>
    <style>
        /* Ocean wave effect */
        .wave-container {
            position: relative;
            overflow: hidden;
            height: 150px;
            background: linear-gradient(45deg, #ff6a00, #ee0979, #ff0099, #493240);
            background-size: 400% 400%;
            animation: wave-left-right 10s ease-in-out infinite, wave-motion 10s ease-out forwards;
        }

        @keyframes wave-left-right {
            0% {
                background-position: -100% 0;
            }
            50% {
                background-position: 100% 0;
            }
            100% {
                background-position: -100% 0;
            }
        }

        @keyframes wave-motion {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(0);
            }
        }

        /* Header Styling */
        header {
            text-align: center;
            margin: 20px 0;
        }

        .research-header h1 {
            font-size: 36px;
            color: #333;
        }

        .research-header p {
            font-size: 18px;
            color: #666;
        }

        /* GitHub Link Styling */
        .github-link {
            display: block;
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
        }

        /* Bold and Larger Font for the First Part of the Text */
        .github-link p {
            font-size: 22px;
            font-weight: bold;
            color: #fff; /* Color for the "Submit Your Research via the" text */
        }

        .github-link a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            background-color: #000;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .github-link a:hover {
            background-color: #ff6a00;
        }

        /* Content Styling */
        .research-content {
            text-align: center;
            margin-top: 40px;
        }

        .research-entry {
            background-color: #f5f5f5;
            padding: 20px;
            margin: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<header>
    <div class="research-header">
        <h1>Our Research</h1>
        <p>Discover the latest research and findings from the AI Youth Alliance community. Our members are working on groundbreaking research in AI and related fields.</p>
    </div>
</header>

<!-- GitHub Link Section with Transition -->
<div class="wave-container">
    <div class="github-link">
        <p><span>Submit Your Research via the</span> <a href="https://github.com/AI-Youth-Allance/Research-Paper-Submission/tree/main" target="_blank">AI Youth Alliance Research Paper Submission GitHub Repository</a></p>
    </div>
</div>

<main class="research-content">
    <?php
    $research_folder = '../data/researchs/';  // Folder where research HTML files will be stored
    
    // Check if the directory exists and is readable
    if (is_dir($research_folder) && is_readable($research_folder)) {
        // Get all files in the folder, excluding '.' and '..'
        $research_files = array_diff(scandir($research_folder), array('.', '..'));

        // Check if the directory contains any files
        if (!empty($research_files)) {
            foreach ($research_files as $research_file) {
                // Only include HTML files
                if (pathinfo($research_file, PATHINFO_EXTENSION) == 'html') {
                    $file_path = $research_folder . $research_file;
                    // Make sure the file exists before including it
                    if (file_exists($file_path)) {
                        echo '<div class="research-entry">';
                        include($file_path);  // Include the HTML file of each research entry
                        echo '</div>';
                    } else {
                        echo '<p>Error: The research file could not be found (' . htmlspecialchars($research_file) . ').</p>';
                    }
                }
            }
        } else {
            echo '<p>Coming Soon!</p>';
        }
    } else {
        echo '<p>The research folder is not accessible at the moment. Please try again later.</p>';
    }
    ?>
</main>

<?php include('../includes/footer.php'); ?>

</body>
</html>
