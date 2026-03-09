<?php
/*
 * show_image.php — Serves the image file as raw binary output.
 *
 * This script reads the PNG with fopen (binary mode) and sends it to the browser
 * with the correct Content-Type header. Use it as the URL for an <img> tag, e.g.:
 *   <img src="show_image.php" alt="Screenshot">
 * The browser receives only the image bytes (no HTML), so the image displays.
 * Do not output any HTML or whitespace before the header() call.
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

// Tell the browser this response is a PNG image (required for it to display correctly).
header("Content-Type: image/png");
// Send the raw image bytes; the browser will render them as an image.
echo $data;
