<?php
require_once __DIR__ . '/../classes/Pdo_methods.php';
header('Content-Type: application/json');

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);
$note = trim($data['note'] ?? '');

if ($note === '') {
    echo json_encode(['error' => true, 'message' => 'Note cannot be empty.', 'items' => []]);
    exit;
}

$pdo = new PdoMethods();
$saved = $pdo->otherBinded(
    'INSERT INTO miniapp (note) VALUES (:note)',
    [[':note', $note, 'str']]
);

if ($saved === 'error') {
    echo json_encode(['error' => true, 'message' => 'Could not add the note.', 'items' => []]);
    exit;
}

$rows = $pdo->selectNotBinded('SELECT note FROM miniapp ORDER BY id ASC');
if ($rows === 'error') {
    echo json_encode(['error' => true, 'message' => 'Note was saved but the list could not be loaded.', 'items' => []]);
    exit;
}

$items = [];
foreach ($rows as $row) {
    $items[] = $row['note'];
}

echo json_encode([
    'error' => false,
    'message' => 'Note added.',
    'items' => $items
]);
