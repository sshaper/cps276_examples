<?php

$url = 'http://147.182.217.199/';

// Initialize a cURL session
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_VERBOSE, true); // Enable verbose output

// Open file handle to capture verbose output
$verbose = fopen('php://temp', 'w+');
curl_setopt($ch, CURLOPT_STDERR, $verbose);

// Execute cURL session
$html = curl_exec($ch);

// Check for errors
if ($html === false) {
    echo "cURL Error: " . curl_error($ch) . "\n";

    // Seek to the beginning and read the verbose log
    rewind($verbose);
    $verboseLog = stream_get_contents($verbose);
    echo "Verbose information:\n" . htmlspecialchars($verboseLog) . "\n";
} else {
    // Get HTTP response code
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    echo "HTTP Response Code: " . $httpCode . "\n";

    // Print detailed cURL information
    $info = curl_getinfo($ch);
    print_r($info);

    // Check if the content is empty
    if (strlen($html) == 0) {
        echo "The response content is empty.\n";
    } else {
        // Output the raw response
        echo $html;
    }
}

// Close cURL session and verbose file handle
curl_close($ch);
fclose($verbose);

// Additional environment information
echo "User: " . get_current_user() . "\n";
echo "Current Directory: " . getcwd() . "\n";
?>
