<?php
/**
 * updateContact.php — Fetch POST controller (not an HTML page)
 *
 * JavaScript sends one row's edited fields plus id.
 * This file validates (same rules as add), runs UPDATE, and returns JSON.
 *
 * Flow:
 *   Update button  →  JSON POST  →  this file  →  Validation + PDO  →  JSON back
 */

require_once __DIR__ . '/../classes/Validation.php';
require_once __DIR__ . '/../classes/Pdo_methods.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'error' => true,
        'message' => 'Use POST to update a contact.'
    ]);
    exit;
}

// JSON is in php://input, not $_POST (Chapter 13).
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!is_array($data)) {
    echo json_encode([
        'error' => true,
        'message' => 'Invalid JSON.'
    ]);
    exit;
}

// Which row to update. Garbage like "abc" becomes 0 and is rejected.
$id = (int)($data['id'] ?? 0);
if ($id < 1) {
    echo json_encode([
        'error' => true,
        'message' => 'Invalid contact id.'
    ]);
    exit;
}

$values = [
    'first_name' => trim($data['first_name'] ?? ''),
    'last_name' => trim($data['last_name'] ?? ''),
    'address' => trim($data['address'] ?? ''),
    'state' => trim($data['state'] ?? ''),
    'zip_code' => trim($data['zip_code'] ?? ''),
    'phone' => trim($data['phone'] ?? ''),
    'email' => trim($data['email'] ?? '')
];

// Same field rules as addContact.php. Database write happens only after these pass.
$errors = [];
$validator = new Validation();

if ($values['first_name'] === '' || !$validator->checkFormat($values['first_name'], 'name', 'You must enter a valid first name')) {
    $errors['first_name'] = 'You must enter a valid first name';
}
if ($values['last_name'] === '' || !$validator->checkFormat($values['last_name'], 'name', 'You must enter a valid last name.')) {
    $errors['last_name'] = 'You must enter a valid last name.';
}
if ($values['address'] === '' || !$validator->checkFormat($values['address'], 'address', 'You must enter a valid address.')) {
    $errors['address'] = 'You must enter a valid address.';
}
if ($values['state'] === '' || $values['state'] === '0') {
    $errors['state'] = 'You must select a state.';
}
if ($values['zip_code'] === '' || !$validator->checkFormat($values['zip_code'], 'zip', 'You must enter a valid zip code.')) {
    $errors['zip_code'] = 'You must enter a valid zip code.';
}
if ($values['phone'] === '' || !$validator->checkFormat($values['phone'], 'phone', 'You must enter a valid phone number.')) {
    $errors['phone'] = 'You must enter a valid phone number.';
}
if ($values['email'] === '' || !$validator->checkFormat($values['email'], 'email', 'You must enter a valid email address.')) {
    $errors['email'] = 'You must enter a valid email address.';
}

if (count($errors) > 0) {
    echo json_encode([
        'error' => true,
        'message' => 'Please correct the highlighted fields',
        'errors' => $errors
    ]);
    exit; // Do not UPDATE.
}

$pdo = new PdoMethods();
$sql = "UPDATE contactMod SET firstName = :fname, lastName = :lname, address = :address, state = :state, zip = :zip, phone = :phone, email = :email WHERE id = :id";
$bindings = [
    [':fname', $values['first_name'], 'str'],
    [':lname', $values['last_name'], 'str'],
    [':address', $values['address'], 'str'],
    [':state', $values['state'], 'str'],
    [':zip', $values['zip_code'], 'str'],
    [':phone', $values['phone'], 'str'],
    [':email', $values['email'], 'str'],
    [':id', $id, 'int'],
];
$result = $pdo->otherBinded($sql, $bindings); // same method as INSERT and DELETE

if ($result === 'error') {
    echo json_encode([
        'error' => true,
        'message' => 'There was an error updating the contact'
    ]);
    exit;
}

echo json_encode([
    'error' => false,
    'message' => 'Contact updated successfully',
    'contact' => [
        'id' => $id,
        'first_name' => $values['first_name'],
        'last_name' => $values['last_name'],
        'address' => $values['address'],
        'state' => $values['state'],
        'zip_code' => $values['zip_code'],
        'phone' => $values['phone'],
        'email' => $values['email']
    ]
]);
