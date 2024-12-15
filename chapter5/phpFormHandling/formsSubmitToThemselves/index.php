<?php
$name = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = "The sent name is {$_POST['name']}";
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Self-submitting Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="container">
    <form action="index.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" class="form-control">
        <input type="submit" name="submitButton" value="Submit" class="btn btn-primary mt-2">
    </form>
    <p><?php echo htmlspecialchars($name); ?></p>
</body>
</html>