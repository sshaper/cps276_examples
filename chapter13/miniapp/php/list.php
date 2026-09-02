<?php
require_once __DIR__ . '/../classes/Pdo_methods.php';
header('Content-Type: application/json');

$pdo = new PdoMethods();
$rows = $pdo->selectNotBinded('SELECT note FROM miniapp ORDER BY id ASC');

if ($rows === 'error') {
    echo json_encode(['error' => true, 'message' => 'Could not load notes.', 'items' => []]);
    exit;
}

$items = [];
foreach ($rows as $row) {
    $items[] = $row['note'];
}

echo json_encode(['error' => false, 'message' => 'OK', 'items' => $items]);
