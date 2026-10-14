
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

// Write the CSV file
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

// Read the CSV file
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

// Separate the header and body rows
$header = $rows[0] ?? [];
$body = array_slice($rows, 1);

// Get the raw file contents
$raw = "";

if (file_exists($path)) {
    $raw = file_get_contents($path);
}

// Prepare the message for display
$messageHTML = "";

if ($msg !== "") {
    $safeMsg = htmlspecialchars($msg);
    $messageHTML = "<p class='alert alert-$alert'>$safeMsg</p>";
}

// Build the HTML table
$tableHTML = "";

if ($header) {

    $tableHTML = "<table class='table table-striped'>";

    // Build the table header
    $tableHTML .= "<thead><tr>";

    foreach ($header as $cell) {
        $safeCell = htmlspecialchars($cell);
        $tableHTML .= "<th>$safeCell</th>";
    }

    $tableHTML .= "</tr></thead>";

    // Build the table body
    $tableHTML .= "<tbody>";

    foreach ($body as $row) {
        $tableHTML .= "<tr>";

        foreach ($row as $cell) {
            $safeCell = htmlspecialchars($cell);
            $tableHTML .= "<td>$safeCell</td>";
        }

        $tableHTML .= "</tr>";
    }

    $tableHTML .= "</tbody>";
    $tableHTML .= "</table>";
}

// Prepare the raw file contents for display
$rawHTML = htmlspecialchars($raw);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Write a CSV File</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="container py-4">

    <h1>Write a CSV File</h1>

    <p>
        Each visit rewrites <code>users.csv</code> next to this
        script using <code>fputcsv</code>, then reads it back
        with <code>fgetcsv</code>.
    </p>

    <p>
        <a href="read_write.php">Read and write a text file</a>
    </p>

    <?php echo $messageHTML; ?>

    <?php echo $tableHTML; ?>

    <h2>File contents</h2>

    <pre class="border p-3 bg-light"><?php echo $rawHTML; ?></pre>

</body>
</html>
