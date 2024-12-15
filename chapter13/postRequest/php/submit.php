<?php
// Get the raw POST data.
$postData = file_get_contents('php://input');

// Decode the JSON data.  True means it is now an associative array
$data = json_decode($postData, true);

// Here you would process the data (e.g., save to database)
// For this example, just return the received data with a success message

header('Content-Type: application/json');
echo json_encode([
    "message" => "Data successfully received!",
    "received" => $data
]);
?>
