<?php
$folder = __DIR__ . "/files";
$source = $folder . "/example.txt";
$copy = $folder . "/example_copy.txt";
$renamed = $folder . "/example_renamed.txt";
$msg = "";

if (!is_dir($folder)) {
    mkdir($folder);
    chmod($folder, 0777);
}
if (!file_exists($source)) {
    file_put_contents($source, "Hello from the manage_files example.");
    chmod($source, 0666);
}

if (isset($_POST["copy"])) {
    if (file_exists($source)) {
        copy($source, $copy);
        $msg = "Copied to example_copy.txt";
    } else {
        $msg = "Source file missing.";
    }
}

if (isset($_POST["rename"])) {
    if (file_exists($copy)) {
        rename($copy, $renamed);
        $msg = "Renamed copy to example_renamed.txt";
    } else {
        $msg = "example_copy.txt not found. Copy first.";
    }
}

if (isset($_POST["delete"])) {
    if (file_exists($renamed)) {
        unlink($renamed);
        $msg = "Deleted example_renamed.txt";
    } else {
        $msg = "Renamed file not found.";
    }
}

$listing = glob($folder . "/*");
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
  <p>Uses <code>copy</code>, <code>rename</code>, and <code>unlink</code> with existence checks.</p>
  <form method="post" class="mb-3">
    <button class="btn btn-primary" name="copy" value="1">1. Copy</button>
    <button class="btn btn-secondary" name="rename" value="1">2. Rename copy</button>
    <button class="btn btn-danger" name="delete" value="1">3. Delete renamed</button>
  </form>
  <?php if ($msg !== ""): ?>
    <p class="alert alert-info"><?php echo htmlspecialchars($msg); ?></p>
  <?php endif; ?>
  <h2>Files in ./files</h2>
  <ul>
    <?php foreach ($listing as $file): ?>
      <li><?php echo htmlspecialchars(basename($file)); ?></li>
    <?php endforeach; ?>
  </ul>
</body>
</html>
