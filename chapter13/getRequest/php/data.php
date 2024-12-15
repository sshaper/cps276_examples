<?php
$data = [
    "name" => "John Doe",
    "age" => 30,
    "city" => "New York"
];

header('Content-Type: application/json');
echo json_encode($data);
?>