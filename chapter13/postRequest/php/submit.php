<?php
// Get the raw POST data from the request body
// php://input is a read-only stream that allows reading raw data from the request body
$postData = file_get_contents('php://input');

// Convert the JSON string into a PHP associative array
// The 'true' parameter makes it return an associative array instead of an object
$data = json_decode($postData, true);

// In a real application, you would process the data here:
// - Validate the input
// - Sanitize the data
// - Save to a database
// - Send emails
// etc.

// Set the response header to indicate we're sending JSON data
header('Content-Type: application/json');

// Create and send the response
// - Include a success message
// - Echo back the received data to confirm it was processed
echo json_encode([
    "message" => "Data successfully received!",  // Success message
    "received" => $data                         // Echo back the received data
]);
?>
