<?php
/**
 * addContact.php — Fetch POST controller (not an HTML page)
 *
 * Chapter 13 taught Fetch calling a PHP file. This is that same idea:
 * JavaScript sends JSON, this file validates, inserts, and returns JSON.
 *
 * Table: contactMod. JSON keys (first_name, zip_code) map to columns
 * (firstName, zip). User text is bound, never concatenated into SQL.
 *
 * Flow:
 *   contacts.js  →  JSON POST  →  this file  →  Validation + PDO  →  JSON back
 */

// __DIR__ is this file's folder (controllers/). Go up one level, then into classes/.
// Needed because Fetch requests THIS file directly, not index.php.
require_once __DIR__ . '/../classes/Validation.php';
require_once __DIR__ . '/../classes/Pdo_methods.php';

// Tell the browser the response is JSON, not HTML. Must happen before any output.
header('Content-Type: application/json');

// Opening this URL in a browser is a GET. Add only works with POST from Fetch.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'error' => true,
        'message' => 'Use POST to add a contact.'
    ]);
    exit; // Stop so we do not print a second JSON object later.
}

// JSON bodies do NOT land in $_POST. php://input is the raw request body (Chapter 13).
$raw = file_get_contents('php://input');
$data = json_decode($raw, true); // true = associative array, like $data['email']

// json_decode failed or the body was empty / not an object.
if (!is_array($data)) {
    echo json_encode([
        'error' => true,
        'message' => 'Invalid JSON.'
    ]);
    exit;
}

// Copy each field. ?? '' means: if the key is missing, use an empty string.
// trim() removes extra spaces even if JavaScript already trimmed (never trust the browser).
$values = [
    'first_name' => trim($data['first_name'] ?? ''),
    'last_name' => trim($data['last_name'] ?? ''),
    'address' => trim($data['address'] ?? ''),
    'state' => trim($data['state'] ?? ''),
    'zip_code' => trim($data['zip_code'] ?? ''),
    'phone' => trim($data['phone'] ?? ''),
    'email' => trim($data['email'] ?? '')
];

// Field-keyed errors become the JSON "errors" object JavaScript reads (errors.email, etc.).
$errors = [];
$validator = new Validation();

// Empty OR bad format both fail. checkFormat uses regex from Validation.php.
if ($values['first_name'] === '' || !$validator->checkFormat($values['first_name'], 'name', 'You must enter a valid first name')) {
    $errors['first_name'] = 'You must enter a valid first name';
}
if ($values['last_name'] === '' || !$validator->checkFormat($values['last_name'], 'name', 'You must enter a valid last name.')) {
    $errors['last_name'] = 'You must enter a valid last name.';
}
if ($values['address'] === '' || !$validator->checkFormat($values['address'], 'address', 'You must enter a valid address.')) {
    $errors['address'] = 'You must enter a valid address.';
}
// "0" is the "Please Select a State" option in the HTML <select>.
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

// Do NOT insert if anything failed. JavaScript will highlight the fields from "errors".
if (count($errors) > 0) {
    echo json_encode([
        'error' => true,
        'message' => 'Please correct the highlighted fields',
        'errors' => $errors
    ]);
    exit;
}

// Validation passed. Now talk to MySQL through the Chapter 9 PdoMethods class.
$pdo = new PdoMethods();
$sql = "INSERT INTO contactMod (firstName, lastName, address, state, zip, phone, email) VALUES (:fname, :lname, :address, :state, :zip, :phone, :email)";
// Each binding is [placeholder, value, type]. User text never concatenates into the SQL string.
$bindings = [
    [':fname', $values['first_name'], 'str'],
    [':lname', $values['last_name'], 'str'],
    [':address', $values['address'], 'str'],
    [':state', $values['state'], 'str'],
    [':zip', $values['zip_code'], 'str'],
    [':phone', $values['phone'], 'str'],
    [':email', $values['email'], 'str'],
];
$result = $pdo->otherBinded($sql, $bindings); // returns "noerror" or "error"

if ($result === 'error') {
    echo json_encode([
        'error' => true,
        'message' => 'There was an error adding the contact'
    ]);
    exit;
}

// otherBinded does not return the new id. Read the newest row so JSON can include "contact".
$newest = $pdo->selectNotBinded('SELECT * FROM contactMod ORDER BY id DESC LIMIT 1');
$contact = null;
if (is_array($newest) && count($newest) > 0) {
    $row = $newest[0];
    // Map database column names (firstName) to the JSON contract keys (first_name).
    $contact = [
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

// Success contract: error false, a message, and the new contact object.
echo json_encode([
    'error' => false,
    'message' => 'Contact added successfully',
    'contact' => $contact
]);
