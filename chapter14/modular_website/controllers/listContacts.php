<?php
/**
 * listContacts.php — Fetch GET controller (not an HTML page)
 *
 * Same idea as Chapter 13 list.php: JavaScript asks for data,
 * PHP reads the database and returns JSON. No page reload.
 *
 * The HTML page is views/listContactsView.php (and the update/delete
 * page also calls this same endpoint). This file is only the JSON API.
 */

require_once __DIR__ . '/../classes/Pdo_methods.php';

header('Content-Type: application/json');

$pdo = new PdoMethods();
// No user values in this SQL, so selectNotBinded is the right Chapter 9 method.
$rows = $pdo->selectNotBinded('SELECT * FROM contactMod');

// PdoMethods returns the string "error" when the query fails (not an array).
if ($rows === 'error') {
    echo json_encode([
        'error' => true,
        'message' => 'Could not load contacts',
        'contacts' => []
    ]);
    exit;
}

// Convert each MySQL row into the JSON shape contacts.js expects.
// Database: firstName, zip   JSON: first_name, zip_code
$contacts = [];
foreach ($rows as $row) {
    $contacts[] = [
        'id' => (int)$row['id'],
        'first_name' => $row['firstName'],
        'last_name' => $row['lastName'],
        'address' => $row['address'],
        'state' => $row['state'],
        'zip_code' => $row['zip'],
        'phone' => $row['phone'],
        'email' => $row['email']
    ];
}

// Empty table is still success: error false and contacts: []
echo json_encode([
    'error' => false,
    'message' => 'OK',
    'contacts' => $contacts
]);
