<?php
$folder = __DIR__ . "/files";
$source = $folder . "/example.txt";
$copy = $folder . "/example_copy.txt";
$renamed = $folder . "/example_renamed.txt";
$msg = "";
$alert = "info";

if (!is_dir($folder)) {
    mkdir($folder);
    chmod($folder, 0777);
}
if (!file_exists($source)) {
    file_put_contents($source, "Hello from the manage_files example.");
    chmod($source, 0666);
}

if (isset($_POST["copy"])) {
    if (!file_exists($source)) {
        $msg = "Source file missing.";
        $alert = "danger";
    } elseif (copy($source, $copy)) {
        $msg = "copy() returned true. Copied to example_copy.txt.";
        $alert = "success";
    } else {
        $msg = "copy() returned false.";
        $alert = "danger";
    }
}

if (isset($_POST["rename"])) {
    if (!file_exists($copy)) {
        $msg = "example_copy.txt not found. Copy first.";
        $alert = "danger";
    } elseif (rename($copy, $renamed)) {
        $msg = "rename() returned true. Renamed the copy to example_renamed.txt.";
        $alert = "success";
    } else {
        $msg = "rename() returned false.";
        $alert = "danger";
    }
}

if (isset($_POST["delete"])) {
    if (!file_exists($renamed)) {
        $msg = "example_renamed.txt not found. Copy, then rename, then delete.";
        $alert = "danger";
    } elseif (unlink($renamed)) {
        $msg = "unlink() returned true. Deleted example_renamed.txt.";
        $alert = "success";
    } else {
        $msg = "unlink() returned false.";
        $alert = "danger";
    }
}

$listing = glob($folder . "/*") ?: [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Copy / Rename / Delete</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1>File Management Mini Practice</h1>
  <p>Uses <code>copy</code>, <code>rename</code>, and <code>unlink</code>. Each button checks that the file exists, then shows whether the function returned true.</p>
  <form method="post" class="mb-3">
    <button class="btn btn-primary" name="copy" value="1">1. Copy</button>
    <button class="btn btn-secondary" name="rename" value="1">2. Rename copy</button>
    <button class="btn btn-danger" name="delete" value="1">3. Delete renamed</button>
  </form>
  <?php if ($msg !== ""): ?>
    <p class="alert alert-<?php echo $alert; ?>"><?php echo htmlspecialchars($msg); ?></p>
  <?php endif; ?>
  <h2>Files in the files folder</h2>
  <ul>
    <?php foreach ($listing as $file): ?>
      <li><?php echo htmlspecialchars(basename($file)); ?></li>
    <?php endforeach; ?>
  </ul>
</body>
</html>
