<?php
/**
 * addContactView.php — HTML for the Add Contact screen only
 *
 * The router calls init() and index.php echoes the returned string.
 * This view does not talk to the database. contacts.js submits with Fetch
 * to controllers/addContact.php.
 *
 * Field ids (first_name, zip_code, ...) must match getFormData() and #error_first_name.
 */
function init() {
    return <<<HTML

<div class="container mt-5">
  <h2>Add Contact</h2>
<!-- Overall success/error sentence. JavaScript writes into this. -->
<p>Fields with * are required.</p>
<p id="acknowledgment"></p>
  <!-- No action/method: preventDefault + Fetch send the data, not a classic form POST. -->
  <form id="contactForm">
    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="first_name" class="form-label">*First Name</label>
        <!-- id must match getFormData() and #error_first_name -->
        <input type="text" class="form-control" id="first_name" name="first_name" value="Scott">
        <div id="error_first_name" class="text-danger"></div>
      </div>
      <div class="col-md-6 mb-3">
        <label for="last_name" class="form-label">*Last Name</label>
        <input type="text" class="form-control" id="last_name" name="last_name" value="Shaper">
        <div id="error_last_name" class="text-danger"></div>
      </div>
    </div>
    <div class="mb-3">
      <label for="address" class="form-label">*Address</label>
      <input type="text" class="form-control" id="address" name="address" value="123 Main St">
      <div id="error_address" class="text-danger"></div>
    </div>
    <div class="row">
      <div class="col-md-3 mb-3">
        <label for="state" class="form-label">*State</label>
        <select class="form-select" id="state" name="state">
          <!-- value="0" is treated as "not selected" in JS and PHP -->
          <option value="0">Please Select a State</option>
          <option value="ca">California</option>
          <option value="tx">Texas</option>
          <option value="mi" selected>Michigan</option>
          <option value="ny">New York</option>
          <option value="fl">Florida</option>
        </select>
        <div id="error_state" class="text-danger"></div>
      </div>
      <div class="col-md-3 mb-3">
        <label for="zip_code" class="form-label">*Zip Code</label>
        <input type="text" class="form-control" id="zip_code" name="zip_code" value="12345">
        <div id="error_zip_code" class="text-danger"></div>
      </div>
      <div class="col-md-3 mb-3">
        <label for="phone" class="form-label">*Phone (format: 123.456.7890)</label>
        <input type="text" class="form-control" id="phone" name="phone" value="999.999.9999">
        <div id="error_phone" class="text-danger"></div>
      </div>
      <div class="col-md-3 mb-3">
        <label for="email" class="form-label">*Email</label>
        <input type="text" class="form-control" id="email" name="email" value="sshaper@wccnet.edu">
        <div id="error_email" class="text-danger"></div>
      </div>
    </div>
    <input type="submit" class="btn btn-primary" id="addContactBtn" value="Add Contact">
  </form>
</div>
<!-- Load JS last so #contactForm already exists when the script runs. -->
<script src="js/contacts.js"></script>
HTML;
}
?>
