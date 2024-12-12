<?php include('../includes/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Events</title>
    <style>
            .no-events-message { 
                background-color: rgb(255, 214, 34); /* Orange background */
                color: white;
                padding: 20px;
                font-size: 1.2em;
                text-align: center;
                border-radius: 8px;
                margin-top: 20px;
                width: 80%; /* Control the width */
                margin-left: auto;
                margin-right: auto;
                transition: background-color 0.3s ease, transform 0.3s ease; /* Add smooth transitions */
            }

            .no-events-message:hover {
                background-color: rgb(255, 87, 34); /* Orange on hover */
                transform: scale(1.05); /* Slight zoom effect */
            }

            .event-entry {
                margin-bottom: 30px;
                text-align: center;
            }

            .event-entry h3 {
                color: rgb(255, 0, 200); /* Pink text */
                font-size: 5em;
                transition: color 0.3s ease;
            }

            .event-entry h3:hover {
                color: rgb(33, 150, 243); /* Blue text on hover */
            }

            .event-content {
                padding: 10px;
                background-color: rgb(253, 253, 253); /* Light gray background */
                border: 1px solid #ddd;
                border-radius: 5px;
                width: 70%; /* Control the width */
                margin-left: auto;
                margin-right: auto; /* Center the event content */
                transition: background-color 0.3s ease;
            }

            .event-content:hover {
                background-color: rgb(240, 240, 240); /* Darker gray on hover */
            }

            .event-links {
                margin-top: 10px;
                text-align: center;
            }

            .event-links a {
                margin-right: 20px;
                text-decoration: none;
                background-color: rgb(7, 73, 255); /* Blue background */
                color: white;
                padding: 10px 15px;
                border-radius: 5px;
                font-size: 1.1em;
                display: inline-block;
                transition: background-color 0.3s ease, transform 0.3s ease;
            }

            .event-links a:hover {
                background-color: rgb(255, 87, 34); /* Orange on hover */
                transform: translateY(-3px); /* Slight lift effect */
            }

    </style>
</head>
<body>

<header>
    <div class="events-header">
        <h1>Our Events</h1>
        <p>Stay up to date with our latest events, workshops, and AI-related activities!</p>
    </div>
</header>

<main class="events-content">
    <?php
    // Define both folders for upcoming and past events
    $upcoming_folder = '../data/events/upcoming_events'; 
    $past_folder = '../data/events/past_events'; 

    // Define an array to keep track of already processed event titles
    $event_titles = [];

    // Define an array of folders for both Upcoming and Past events
    $folders = [
        'Upcoming Events' => $upcoming_folder,
        'Past Events' => $past_folder
    ];

    // Loop through each folder for upcoming and past events
    foreach ($folders as $section_title => $folder) {
        if (is_dir($folder)) {
            $events = array_diff(scandir($folder), array('.', '..'));  // Get all files except '.' and '..'

            if (!empty($events)) {
                echo "<h2>$section_title</h2>";  // Show the section title only once

                // Loop through each event file in the folder
                foreach ($events as $event_file) {
                    // Only include HTML files
                    if (pathinfo($event_file, PATHINFO_EXTENSION) == 'html') {
                        // Get event content from the file
                        $event_content = file_get_contents($folder . '/' . $event_file);

                        // Extract event details using regex
                        preg_match('/<h1 class="event-title">(.*?)<\/h1>/', $event_content, $matches);
                        $event_title = isset($matches[1]) ? $matches[1] : '';

                        preg_match('/<p class="event-date">(.*?)<\/p>/', $event_content, $matches);
                        $event_date = isset($matches[1]) ? $matches[1] : '';

                        preg_match('/<p class="event-location">(.*?)<\/p>/', $event_content, $matches);
                        $event_location = isset($matches[1]) ? $matches[1] : '';

                        preg_match('/<p class="event-description">(.*?)<\/p>/s', $event_content, $matches);
                        $event_description = isset($matches[1]) ? $matches[1] : '';

                        // Extract the registration or watch link
                        preg_match('/<a href="(.*?)" class="event-link">/', $event_content, $link_matches);
                        $event_link = isset($link_matches[1]) ? $link_matches[1] : '';

                        // If the event title is not null and not already processed, display it
                        if (!empty($event_title) && !in_array($event_title, $event_titles)) {
                            // Mark this title as processed
                            $event_titles[] = $event_title;

                            // Display the event title and content
                            echo '<div class="event-entry">';
                            echo '<h3>' . htmlspecialchars($event_title) . '</h3>';
                            echo '<p><strong>Date:</strong> ' . htmlspecialchars($event_date) . '</p>';
                            echo '<p><strong>Location:</strong> ' . htmlspecialchars($event_location) . '</p>';
                            echo '<div class="event-content">' . $event_description . '</div>'; // Display description directly
                            
                            // Add registration or watch link based on event category
                            echo '<div class="event-links">';
                            if ($section_title == 'Upcoming Events') {
                                echo '<a href="' . htmlspecialchars($event_link) . '" class="register-link">Register Now</a>';
                            } else if ($section_title == 'Past Events') {
                                echo '<a href="' . htmlspecialchars($event_link) . '" class="watch-link">Watch the Recording</a>';
                            }
                            echo '</div>'; // End of event-links div
                            echo '</div>';
                        }
                    }
                }
            } else {
                // Show a message if no events are available in the folder
                echo '<div class="no-events-message">Stay tuned for upcoming events! We will be sharing updates shortly. Check back soon for more information.</div>';
            }
        } else {
            echo '<div class="no-events-message">Stay tuned for upcoming events! We will be sharing updates shortly. Check back soon for more information.</div>';
        }
    }
    ?>
</main>

<?php include('../includes/footer.php'); ?>

</body>
</html>
