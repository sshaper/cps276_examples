<?php
$output = "";
$favoriteWidgets = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $favoriteWidgets = $_POST['favoriteWidgets'];
    
    foreach ($favoriteWidgets as $widgets) {
        $output .= "<p>$widgets</p>";
    }
}
else {
    $output = "No widgets sent.";
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