<?php
/**
 * addContact controller
 * - Builds $values for the form (defaults or posted data)
 * - Validates on POST with Validation class
 * - Inserts with PdoMethods only when there are no errors
 * - Does NOT use StickyForm
 */

require_once('classes/Validation.php');
require_once('classes/Pdo_methods.php');

$acknowledgment = "<p></p>";
$errors = [];

$values = [
    'first_name' => 'Scott',
    'last_name' => 'Shaper',
    'address' => '123 Anyplace',
    'state' => 'mi',
    'zip_code' => '12345',
    'phone' => '999.999.9999',
    'email' => 'sshaper@wccnet.edu'
];

$states = [
    '0' => 'Please Select a State',
    'ca' => 'California',
    'tx' => 'Texas',
    'mi' => 'Michigan',
    'ny' => 'New York',
    'fl' => 'Florida'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Copy posted values (trimmed) into $values so the form can redisplay them
    foreach ($values as $key => $default) {
        $values[$key] = trim($_POST[$key] ?? '');
    }

    $validator = new Validation();

    // Validate each required field. Store messages under the field name for the view.
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

    // Only talk to the database when every field passed
    if (count($errors) === 0) {
        $pdo = new PdoMethods();
        $sql = "INSERT INTO contactMod (firstName, lastName, address, state, zip, phone, email) VALUES (:fname, :lname, :address, :state, :zip, :phone, :email)";
        $bindings = [
            [':fname', $values['first_name'], 'str'],
            [':lname', $values['last_name'], 'str'],
            [':address', $values['address'], 'str'],
            [':state', $values['state'], 'str'],
            [':zip', $values['zip_code'], 'str'],
            [':phone', $values['phone'], 'str'],
            [':email', $values['email'], 'str'],
        ];
        $result = $pdo->otherBinded($sql, $bindings);

        if ($result === 'error') {
            $acknowledgment = '<p class="text-danger">There was an error adding the contact</p>';
        } else {
            $acknowledgment = '<p class="text-success">Contact has been added</p>';
        }
    }
}

/** Helper used by the view to print a field error safely */
function fieldError($errors, $key) {
    if (!isset($errors[$key])) {
        return '';
    }
    return '<div class="text-danger">' . htmlspecialchars($errors[$key]) . '</div>';
}
