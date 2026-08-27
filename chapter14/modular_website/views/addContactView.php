<?php
/**
 * addContactView
 * Builds the HTML form using $values / $errors from the controller.
 * Escapes output and shows per-field errors.
 */
require_once 'controllers/addContact.php';

function init() {
    global $values, $errors, $acknowledgment, $states;

    // Escape every value before putting it into HTML attributes
    $firstName = htmlspecialchars($values['first_name']);
    $lastName = htmlspecialchars($values['last_name']);
    $address = htmlspecialchars($values['address']);
    $zip = htmlspecialchars($values['zip_code']);
    $phone = htmlspecialchars($values['phone']);
    $email = htmlspecialchars($values['email']);

    $errFirst = fieldError($errors, 'first_name');
    $errLast = fieldError($errors, 'last_name');
    $errAddress = fieldError($errors, 'address');
    $errState = fieldError($errors, 'state');
    $errZip = fieldError($errors, 'zip_code');
    $errPhone = fieldError($errors, 'phone');
    $errEmail = fieldError($errors, 'email');

    $stateOptions = '';
    foreach ($states as $code => $label) {
        $selected = ($values['state'] === (string)$code) ? 'selected' : '';
        $stateOptions .= '<option value="' . htmlspecialchars((string)$code) . '" ' . $selected . '>' . htmlspecialchars($label) . '</option>';
    }

    return <<<HTML
{$acknowledgment}
<div class="container mt-5">
  <p>Fields with * are required. Phone format: 123.456.7890</p>
  <form method="post" action="" id="contactForm">
    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="first_name" class="form-label">*First Name</label>
        <input type="text" class="form-control" id="first_name" name="first_name" value="{$firstName}">
        {$errFirst}
      </div>
      <div class="col-md-6 mb-3">
        <label for="last_name" class="form-label">*Last Name</label>
        <input type="text" class="form-control" id="last_name" name="last_name" value="{$lastName}">
        {$errLast}
      </div>
    </div>
    <div class="mb-3">
      <label for="address" class="form-label">*Address</label>
      <input type="text" class="form-control" id="address" name="address" value="{$address}">
      {$errAddress}
    </div>
    <div class="row">
      <div class="col-md-3 mb-3">
        <label for="state" class="form-label">*State</label>
        <select class="form-select" id="state" name="state">{$stateOptions}</select>
        {$errState}
      </div>
      <div class="col-md-3 mb-3">
        <label for="zip_code" class="form-label">*Zip Code</label>
        <input type="text" class="form-control" id="zip_code" name="zip_code" value="{$zip}">
        {$errZip}
      </div>
      <div class="col-md-3 mb-3">
        <label for="phone" class="form-label">*Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{$phone}">
        {$errPhone}
      </div>
      <div class="col-md-3 mb-3">
        <label for="email" class="form-label">*Email</label>
        <input type="text" class="form-control" id="email" name="email" value="{$email}">
        {$errEmail}
      </div>
    </div>
    <div id="jsError" class="text-danger mb-2"></div>
    <input type="submit" class="btn btn-primary" value="Add Contact">
  </form>
</div>
<script src="js/contacts.js"></script>
HTML;
}
?>
