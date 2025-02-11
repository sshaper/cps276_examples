<?php
$output = ""; // Initialize an empty string to store output
$favoriteWidgets = []; // Initialize an empty array to store selected widgets

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if 'favoriteWidgets' exists in the POST request
    if(isset($_POST['favoriteWidgets'])){
        $favoriteWidgets = $_POST['favoriteWidgets']; // Retrieve the selected widgets from POST data
        
        // Loop through each selected widget and append it to the output string
        foreach ($favoriteWidgets as $widgets) {
            $output .= "<p>$widgets</p>"; // Append each widget in a paragraph element
        }
    }
    else {
        $output = "No widgets selected."; // Handle case where no widgets were selected
    }

} 
else {
    $output = "No post request sent"; // Handle case where request method is not POST
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Favorite Widgets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="container">
    <h1>Favorite Widgets:</h1>
    <?php echo $output; ?>
</body>
</html>