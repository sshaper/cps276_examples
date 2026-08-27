<?php
$msg = "";
$dir = "mydirectory";

// isset checks whether a variable exists.
if (isset($_POST["create"])) {
    if (!is_dir($dir)) {
        $success = mkdir($dir);
        // Set permissions so the web server can use the folder on russet.
        chmod($dir, 0777);
        $msg = $success ? "Directory Created" : "There was a problem";
    } else {
        $msg = "Directory already exists";
    }
}

if (isset($_POST["remove"])) {
    if (is_dir($dir)) {
        $success = rmdir($dir);
        $msg = $success ? "Directory Removed" : "There was a problem (is it empty?)";
    } else {
        $msg = "Directory does not exist";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Single Directory</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1>Single Directory</h1>
  <p><?php echo htmlspecialchars($msg); ?></p>
  <p>Create and remove one empty directory. Checks with <code>is_dir</code> before acting.</p>
  <p>NOTE: The folder containing this script must be writable (0777 on russet).</p>
  <form action="single_directory.php" method="POST">
    <input type="submit" class="btn btn-primary" name="create" value="Create Directory">
    <input type="submit" class="btn btn-danger" name="remove" value="Remove Directory">
  </form>
</body>
</html>
