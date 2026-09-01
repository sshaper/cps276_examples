<?php
/**
 * listContactsView.php — HTML shell for the read-only contact list
 *
 * Shown when the URL is index.php?page=listContacts.
 * The table body starts empty. contacts.js Fetch-GETs controllers/listContacts.php
 * and fills rows as plain text (not inputs). This view does not run SQL.
 */
function init() {
    return <<<HTML
<div class="container mt-5">
  <h2>Contact List</h2>
  <!-- Loading, empty, and error sentences go here. -->
  <p id="listMessage"></p>
  <div id="contactsPanel">
    <!-- data-mode="list" tells contacts.js to draw plain text, not edit buttons. -->
    <table class="table table-striped table-bordered" id="contactsTable" data-mode="list">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Address</th>
          <th>State</th>
          <th>Zip</th>
          <th>Phone</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody id="contactsTableBody">
      </tbody>
    </table>
  </div>
</div>
<script src="js/contacts.js"></script>
HTML;
}
?>
