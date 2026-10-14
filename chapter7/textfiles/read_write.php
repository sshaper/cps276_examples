
<?php
$folder = __DIR__ . "/files";
$path = $folder . "/data.txt";
$msg = "";
$alert = "info";

// Create the folder if it does not exist
if (!is_dir($folder)) {
    mkdir($folder);
    chmod($folder, 0777);
}

// Create the file if it does not exist
if (!file_exists($path)) {
    file_put_contents($path, "Starter line\n");
    chmod($path, 0666);
}

// Read the file using fopen and fread
if (isset($_POST["read"])) {
    $handle = fopen($path, "r");

    if (!$handle) {
        $msg = "Cannot open data.txt for reading.";
        $alert = "danger";
    } else {
        $size = filesize($path);

        if ($size > 0) {
            fread($handle, $size);
        }

        fclose($handle);
        $msg = "fread() read {$size} bytes. The file is shown below.";
        $alert = "success";
    }
}

// Write to the file using fopen and fwrite
if (isset($_POST["write"])) {
    $handle = fopen($path, "w");

    if (!$handle) {
        $msg = "Cannot open data.txt for writing.";
        $alert = "danger";
    } else {
        fwrite($handle, "Hello World");
        fclose($handle);
        chmod($path, 0666);

        $msg = "fwrite() replaced the file with \"Hello World\".";
        $alert = "success";
    }
}

// Append to the file using fopen and fwrite
if (isset($_POST["append"])) {
    $handle = fopen($path, "a");

    if (!$handle) {
        $msg = "Cannot open data.txt for appending.";
        $alert = "danger";
    } else {
        fwrite($handle, "\nNew content");
        fclose($handle);
        chmod($path, 0666);

        $msg = "fwrite() appended a line using mode \"a\".";
        $alert = "success";
    }
}

// Read the file using file_get_contents
if (isset($_POST["get_contents"])) {
    $data = file_get_contents($path);

    if ($data === false) {
        $msg = "file_get_contents() failed.";
        $alert = "danger";
    } else {
        $msg = "file_get_contents() returned " . strlen($data) . " bytes. They are shown below.";
        $alert = "success";
    }
}

// Append to the file using file_put_contents
if (isset($_POST["put_contents"])) {
    $line = "This is additional content.\n";

    if (file_put_contents($path, $line, FILE_APPEND) === false) {
        $msg = "file_put_contents() failed.";
        $alert = "danger";
    } else {
        chmod($path, 0666);

        $msg = "file_put_contents() appended a line with FILE_APPEND.";
        $alert = "success";
    }
}

// Get the current file contents
$contents = "";

if (file_exists($path)) {
    $contents = file_get_contents($path);
}

// Prepare the message for display
$messageHTML = "";

if ($msg !== "") {
    $safeMsg = htmlspecialchars($msg);
    $messageHTML = "<p class='alert alert-$alert'>$safeMsg</p>";
}

// Prepare the file contents for display
$contentHTML = htmlspecialchars($contents);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Read and Write a Text File</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="container py-4">

    <h1>Read and Write a Text File</h1>

    <p>
        The sample file is <code>__DIR__ . "/files/data.txt"</code>.
        Write replaces the whole file. Append and
        <code>file_put_contents</code> add to the end.
    </p>

    <p>
        <a href="append_log.php">Append-only log</a>
        |
        <a href="writecsv.php">Write a CSV file</a>
        |
        <a href="checkfile.php">Check, Create, and Delete a File</a>
    </p>

    <form method="post" class="mb-3">

        <button class="btn btn-primary" name="read" value="1">
            Read with fopen
        </button>

        <button class="btn btn-primary" name="write" value="1">
            Write with fopen
        </button>

        <button class="btn btn-primary" name="append" value="1">
            Append with fopen
        </button>

        <button class="btn btn-secondary" name="get_contents" value="1">
            file_get_contents
        </button>

        <button class="btn btn-secondary" name="put_contents" value="1">
            file_put_contents
        </button>

    </form>

    <?php echo $messageHTML; ?>

    <h2>Current data.txt</h2>

    <pre class="border p-3 bg-light"><?php echo $contentHTML; ?></pre>

</body>
</html>
