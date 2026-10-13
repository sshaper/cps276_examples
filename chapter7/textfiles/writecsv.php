<?php
$list = [
    ["Name", "Email", "Role"],
    ["John Doe", "john.doe@example.com", "Admin"],
    ["Jane Smith", "jane.smith@example.com", "User"]
];

$path = __DIR__ . "/users.csv";
$msg = "";
$alert = "info";
$rows = [];

$handle = fopen($path, "w");
if (!$handle) {
    $msg = "Cannot open users.csv for writing.";
    $alert = "danger";
} else {
    foreach ($list as $fields) {
        fputcsv($handle, $fields);
    }
    fclose($handle);
    chmod($path, 0666);
    $msg = "Wrote users.csv with the three rows from the chapter.";
    $alert = "success";
}

if ($alert === "success") {
    $handle = fopen($path, "r");
    if (!$handle) {
        $msg = "Cannot open users.csv for reading.";
        $alert = "danger";
    } else {
        while (($data = fgetcsv($handle)) !== false) {
            $rows[] = $data;
        }
        fclose($handle);
    }
}

$header = $rows[0] ?? [];
$body = array_slice($rows, 1);
$raw = file_exists($path) ? file_get_contents($path) : "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Write a CSV File</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1>Write a CSV File</h1>
  <p>Each visit rewrites <code>users.csv</code> next to this script using <code>fputcsv</code>, then reads it back with <code>fgetcsv</code>.</p>
  <p><a href="read_write.php">Read and write a text file</a></p>
  <?php if ($msg !== ""): ?>
    <p class="alert alert-<?php echo $alert; ?>"><?php echo htmlspecialchars($msg); ?></p>
  <?php endif; ?>

  <?php if ($header): ?>
    <table class="table table-striped">
      <thead>
        <tr>
          <?php foreach ($header as $cell): ?>
            <th><?php echo htmlspecialchars($cell); ?></th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($body as $row): ?>
          <tr>
            <?php foreach ($row as $cell): ?>
              <td><?php echo htmlspecialchars($cell); ?></td>
            <?php endforeach; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>

  <h2>File contents</h2>
  <pre class="border p-3 bg-light"><?php echo htmlspecialchars($raw); ?></pre>
</body>
</html>
