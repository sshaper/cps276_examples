<?php
/*
 * show_image_web.php — Displays the image inside an HTML page using a data URI.
 *
 * This script reads the PNG with fopen (binary mode), encodes it as base64,
 * and embeds it in a data: URL so the <img> tag can show the image on the same
 * page. Good when you want both HTML content and the image in one response.
 * For large images, prefer linking to show_image.php instead (smaller response).
 */

try {
    // Open the image in binary mode ("rb") so bytes are not modified (required for images).  NOTE: On this server, you don't need to use "rb" instead of "r" to avoid line ending conversions.
    if (!($handle = fopen("mac-screenshot.png", "rb"))) {
        throw new Exception("Cannot open file for reading");
    }
    // Read the entire file into $data (raw bytes).
    $data = fread($handle, filesize("mac-screenshot.png"));
    fclose($handle);
} catch (Exception $e) {
    error_log("Error reading file: " . $e->getMessage());
}

// Build a data URI: the browser can use this as an img src without a separate request.
// base64_encode() makes the binary data safe to put in an HTML attribute.
$dataUri = 'data:image/png;base64,' . base64_encode($data);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- The src is a data URI, so the image is embedded in this page. -->
    <img src="<?php echo $dataUri; ?>" alt="Mac Screenshot">
</body>
</html>