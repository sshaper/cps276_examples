<?php
header("Content-Type: application/json");

$file = __DIR__ . "/notes.json";
if (!file_exists($file)) {
    file_put_contents($file, json_encode(["Buy milk", "Finish CPS276 lab"]));
}

$items = json_decode(file_get_contents($file), true);
if (!is_array($items)) {
    echo json_encode(["error" => true, "message" => "Could not read notes.", "items" => []]);
    exit;
}

echo json_encode(["error" => false, "message" => "OK", "items" => $items]);
