<?php
$msg = "";
$dir = __DIR__ . "/mydirectory";

if (isset($_POST["create"])) {
    if (!is_dir($dir)) {
        $success = mkdir($dir);
        if ($success) {
            chmod($dir, 0777);
            $msg = "Directory created at: " . htmlspecialchars($dir);
        } else {
            $msg = "mkdir failed.";
        }
    } else {
        $msg = "Directory already exists. Skipped create.";
    }
}

if (isset($_POST["check"])) {
    if (!file_exists($dir)) {
        $msg = "Path does not exist.";
    } elseif (is_dir($dir)) {
        $writable = is_writable($dir) ? "yes" : "no";
        $msg = "It is a directory. Writable: {$writable}";
    } else {
        $msg = "Path exists but is not a directory.";
    }
}

if (isset($_POST["remove"])) {
    if (is_dir($dir)) {
        $success = rmdir($dir);
        $msg = $success ? "Directory removed." : "Could not remove (is it empty?).";
    } else {
        $msg = "Nothing to remove — directory does not exist.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Check Directory Before Acting</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1>Check Before Create / Delete</h1>
  <p>Uses <code>file_exists</code>, <code>is_dir</code>, and <code>is_writable</code> with <code>__DIR__</code>.</p>
  <form method="post" class="mb-3">
    <button class="btn btn-primary" name="create" value="1">Create if missing</button>
    <button class="btn btn-secondary" name="check" value="1">Check status</button>
    <button class="btn btn-danger" name="remove" value="1">Remove if empty</button>
  </form>
  <p class="alert alert-info"><?php echo $msg !== "" ? htmlspecialchars($msg) : "Choose an action."; ?></p>
</body>
</html>
