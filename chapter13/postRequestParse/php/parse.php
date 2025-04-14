<?php
// Get the raw POST data from the request body
// php://input is a read-only stream that allows reading raw data from the request body
$postData = file_get_contents('php://input');

// Convert the JSON string into a PHP associative array
// The 'true' parameter makes it return an associative array instead of an object
$data = json_decode($postData, true);

// Create an HTML table with the data
$table = '<table class="table table-bordered">';
$table .= '<thead><tr><th>Field Name</th><th>Field Value</th></tr></thead>';
$table .= '<tbody>';

// Loop through each field in the data
foreach ($data as $field => $value) {
    // Add a row for each field-value pair
    $table .= "<tr>";
    $table .= "<td>{$field}</td>";
    $table .= "<td>" . htmlspecialchars($value) . "</td>";
    $table .= "</tr>";
}

$table .= '</tbody></table>';

// Set the response header to indicate we're sending JSON data
header('Content-Type: application/json');

// Create and send the response
// - Include a success message
// - Echo back the received data to confirm it was processed
echo json_encode([
    "message" => "Data successfully received!",  // Success message
    "table" => $table,                          // HTML table with the data
    "received" => $data                         // Original data for reference
]);
?>
