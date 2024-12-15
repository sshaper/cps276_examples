<?php
$output = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $output = require 'fileOperations.php';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>File Operations</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        body {
            font: 100%/1.5 sans-serif;
            padding: 20px;
        }
        .result {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            font-size: 1.5em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>File Operations</h1>
        <form method="post" action="index.php">
            <button type="submit" name="action" value="read" class="btn btn-primary">Read File</button>
            <button type="submit" name="action" value="write" class="btn btn-primary">Write to File</button>
            <button type="submit" name="action" value="append" class="btn btn-primary">Append to File</button>
            <button type="submit" name="action" value="clear" class="btn btn-primary">Clear File</button>
            <button type="submit" name="action" value="copy" class="btn btn-primary">Copy File</button>
            <button type="submit" name="action" value="rename" class="btn btn-primary">Rename Copied File</button>
            <button type="submit" name="action" value="delete" class="btn btn-primary">Delete Renamed File</button>
            <button type="submit" name="action" value="get_contents" class="btn btn-primary">Get File Contents</button>
            <button type="submit" name="action" value="put_contents" class="btn btn-primary">Put File Contents</button>
        </form>
        <div class="result"><?php echo $output ?></div>
    </div>
</body>
</html>
