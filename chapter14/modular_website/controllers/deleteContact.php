<?php
/**
 * deleteContact.php — Fetch POST controller (not an HTML page)
 *
 * JavaScript sends { "id": 12 } for ONE row (the Delete button on that row).
 * This file deletes that contact from contactMod and returns JSON.
 * We use POST (not HTTP DELETE) because that is enough at this course level.
 * There is no bulk delete in this example.
 */

require_once __DIR__ . '/../classes/Pdo_methods.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'error' => true,
        'message' => 'Use POST to delete a contact.'
    ]);
    exit;
}

// Same pattern as add/update: JSON is in php://input, not $_POST.
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!is_array($data)) {
    echo json_encode([
        'error' => true,
        'message' => 'Invalid JSON.'
    ]);
    exit;
}

$id = (int)($data['id'] ?? 0);
if ($id < 1) {
    echo json_encode([
        'error' => true,
        'message' => 'Invalid contact id.'
    ]);
    exit;
}

$pdo = new PdoMethods();
$sql = 'DELETE FROM contactMod WHERE id=:id';
$bindings = [
    [':id', $id, 'int'], // bound parameter — user input is not glued into the SQL
];
$result = $pdo->otherBinded($sql, $bindings);

if ($result === 'error') {
    echo json_encode([
        'error' => true,
        'message' => 'There was a problem deleting this record.'
    ]);
    exit;
}

echo json_encode([
    'error' => false,
    'message' => 'Contact deleted successfully'
]);
