<?php
header("Content-Type: application/json");

$file = __DIR__ . "/notes.json";
if (!file_exists($file)) {
    file_put_contents($file, json_encode([]));
}

$raw = file_get_contents("php://input");
$data = json_decode($raw, true);
$note = trim($data["note"] ?? "");

if ($note === "") {
    echo json_encode(["error" => true, "message" => "Note cannot be empty.", "items" => []]);
    exit;
}

$items = json_decode(file_get_contents($file), true);
if (!is_array($items)) {
    $items = [];
}

$items[] = $note;
file_put_contents($file, json_encode($items, JSON_PRETTY_PRINT));

echo json_encode([
    "error" => false,
    "message" => "Note added.",
    "items" => $items
]);
