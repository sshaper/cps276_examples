<?php
$log = __DIR__ . "/app.log";
$msg = "";

if (isset($_POST["log"])) {
    $line = date("Y-m-d H:i:s") . " - Form submitted by example script\n";
    file_put_contents($log, $line, FILE_APPEND);
    chmod($log, 0666);
    $msg = "Line appended to app.log";
}

if (isset($_POST["clear"])) {
    file_put_contents($log, "");
    $msg = "Log cleared";
}

$contents = file_exists($log) ? file_get_contents($log) : "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Append Log Example</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1>Append-Only Log File</h1>
  <p>Each click adds one timestamped line using <code>FILE_APPEND</code>. Old lines stay.</p>
  <form method="post" class="mb-3">
    <button class="btn btn-primary" name="log" value="1">Add log line</button>
    <button class="btn btn-warning" name="clear" value="1">Clear log</button>
  </form>
  <?php if ($msg !== ""): ?>
    <p class="text-success"><?php echo htmlspecialchars($msg); ?></p>
  <?php endif; ?>
  <h2>Current log</h2>
  <pre class="border p-3 bg-light"><?php echo htmlspecialchars($contents); ?></pre>
</body>
</html>
