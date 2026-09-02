<?php
require_once __DIR__ . '/../classes/Pdo_methods.php';
header('Content-Type: application/json');

$pdo = new PdoMethods();
$deleted = $pdo->otherNotBinded(
    'TRUNCATE TABLE miniapp'
);

if ($deleted === 'error') {
    echo json_encode([
        'error' => true,
        'message' => 'Could not delete the notes.',
    ]);
    exit;
}

echo json_encode([
    'error' => false,
    'message' => 'Notes deleted.',
]);

exit;
