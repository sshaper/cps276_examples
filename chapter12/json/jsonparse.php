<?php
// JSON data as a string
$json = '[
  {
    "title": "Eric Meyer on CSS",
    "author": "Eric Meyer",
    "publisher": "New Riders",
    "editions": [
      {"year": "2002", "edition": "First Edition"}
    ]
  },
  {
    "title": "Web Design in a Nutshell",
    "author": "Jennifer Niederst",
    "publisher": "O\'Reilly and Associates",
    "editions": [
      {"year": "1999", "edition": "First Edition"},
      {"year": "2001", "edition": "Second Edition"},
      {"year": "2006", "edition": "Third Edition"}
    ]
  },
  {
    "title": "JavaScript: The Good Parts",
    "author": "Douglas Crockford",
    "publisher": "O\'Reilly and Associates",
    "editions": [
      {"year": "2008", "edition": "First Edition"}
    ]
  }
]';

// Decode JSON into an associative array
$books = json_decode($json, true);

// Initialize the HTML content
$html = '<h1>Books List</h1>';

if (json_last_error() === JSON_ERROR_NONE) {
    foreach ($books as $book) {
        // Add book details
        $html .= '<div class="book">';
        $html .= '<h2>' . htmlspecialchars($book['title']) . '</h2>';
        $html .= '<p><strong>Author:</strong> ' . htmlspecialchars($book['author']) . '</p>';
        $html .= '<p><strong>Publisher:</strong> ' . htmlspecialchars($book['publisher']) . '</p>';
        
        // Start editions table
        $html .= '<table class="table table-striped table-bordered">';
        $html .= '<thead><tr><th>Year</th><th>Edition</th></tr></thead>';
        $html .= '<tbody>';
        
        foreach ($book['editions'] as $edition) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($edition['year']) . '</td>';
            $html .= '<td>' . htmlspecialchars($edition['edition']) . '</td>';
            $html .= '</tr>';
        }
        
        $html .= '</tbody></table>';
        $html .= '</div>';
    }
} else {
    $html = '<p>Error parsing JSON: ' . htmlspecialchars(json_last_error_msg()) . '</p>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Books List</title>
</head>
<body class="container">
    <?php echo $html; ?>
</body>
</html>