<?php
// Define a JSON string containing book information
$json = '{"book":
    {
        "title": "Web Design in a Nutshell",
        "author": "Jennifer Niederst",
        "publisher": "O\'Reilly and Associates",
        "editions": [
        {"year": "1999", "edition": "First Edition"},
        {"year": "2001", "edition": "Second Edition"},
        {"year": "2006", "edition": "Third Edition"}
        ]
    }
}
';

// Decode the JSON string into a PHP associative array
$data = json_decode($json, true);

// Initialize the HTML content
if (json_last_error() === JSON_ERROR_NONE) {
    // Start building the HTML content with a title
    $html = '<h1>Single Book</h1>';

    // Create a container div for the book information
    $html .= '<div class="book">';
    
    // Add the book title, author, and publisher with proper HTML escaping
    $html .= '<h2>' . htmlspecialchars($data['book']['title']) . '</h2>';
    $html .= '<p><strong>Author:</strong> ' . htmlspecialchars($data['book']['author']) . '</p>';
    $html .= '<p><strong>Publisher:</strong> ' . htmlspecialchars($data['book']['publisher']) . '</p>';

    // Create a Bootstrap-styled table for the book editions
    $html .= '<table class="table table-striped table-bordered">';
    $html .= '<thead><tr><th>Year</th><th>Edition</th></tr></thead>';
    $html .= '<tbody>';

    // Loop through each edition and add it to the table
    foreach ($data['book']['editions'] as $edition) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($edition['year']) . '</td>';
        $html .= '<td>' . htmlspecialchars($edition['edition']) . '</td>';
        $html .= '</tr>';
    }

    // Close the table and container div
    $html .= '</tbody></table>';
    $html .= '</div>';
}
else {
    // Display an error message if JSON parsing failed
    $html = '<p>Error parsing JSON: ' . htmlspecialchars(json_last_error_msg()) . '</p>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Books List</title>
</head>
<body class="container">
    <!-- Output the generated HTML content -->
    <?php echo $html; ?>
</body>
</html>