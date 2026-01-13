<?php
// Define a sample data array with user information
$data = [
    "name" => "John Doe,",  // User's full name
    "age" => 30,         // User's age
    "city" => "New York"  // User's city
];

// Set the HTTP header to indicate we're sending JSON data
// This tells the browser/client how to interpret the response
header('Content-Type: application/json');

// Convert the PHP array to JSON format and output it
// This will be the response sent back to the client
echo json_encode($data);
?>