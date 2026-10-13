
<?php
$path = __DIR__ . "/data.txt";
$msg = "";
$alert = "info";
$content = "";

// Process the button that was clicked
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["check"])) {
        if (file_exists($path)) {
            $msg = "data.txt exists.";
            $alert = "success";
        } else {
            $msg = "data.txt does not exist.";
            $alert = "warning";
        }
    }

    if (isset($_POST["create"])) {
        if (!file_exists($path)) {
            if (file_put_contents($path, "starter text") !== false) {
                $msg = "Created data.txt with starter text.";
                $alert = "success";
            } else {
                $msg = "Cannot create data.txt.";
                $alert = "danger";
            }
        } else {
            $msg = "data.txt already exists.";
            $alert = "warning";
        }
    }

    if (isset($_POST["delete"])) {
        if (file_exists($path)) {
            if (unlink($path)) {
                $msg = "Deleted data.txt.";
                $alert = "success";
            } else {
                $msg = "Cannot delete data.txt.";
                $alert = "danger";
            }
        } else {
            $msg = "data.txt does not exist.";
            $alert = "warning";
        }
    }
}

// Read the file if it exists and is readable
if (is_file($path) && is_readable($path)) {
    $content = file_get_contents($path);
    if ($content === false) {
        $content = "";
        $msg = "Cannot read data.txt.";
        $alert = "danger";
    }
}

$exists = file_exists($path);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Check, Create, and Delete a File</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

  <h1>Check, Create, and Delete a File</h1>

  <p>
    Use the buttons below to check whether
    <code>data.txt</code> exists, create the file,
    or delete it.
  </p>

  <p><a href="read_write.php">Read and write a text file</a></p>

  <form method="post" class="mb-4">
    <button type="submit" name="check" class="btn btn-primary">
      Check File
    </button>

    <button type="submit" name="create" class="btn btn-success">
      Create File
    </button>

    <button type="submit" name="delete" class="btn btn-danger">
      Delete File
    </button>
  </form>

  <?php if ($msg !== ""): ?>
    <p class="alert alert-<?php echo $alert; ?>">
      <?php echo htmlspecialchars($msg); ?>
    </p>
  <?php endif; ?>

  <h2>File Status</h2>
  <p>
    <?php if ($exists): ?>
      <span class="badge bg-success">File Exists</span>
    <?php else: ?>
      <span class="badge bg-secondary">File Does Not Exist</span>
    <?php endif; ?>
  </p>

  <h2>File Contents</h2>
  <pre class="border p-3 bg-light"><?php echo htmlspecialchars($content); ?></pre>

</body>
</html>
