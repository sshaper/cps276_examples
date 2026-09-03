<?php
/**
 * updateDeleteContactsView.php — HTML shell for list / update / delete
 *
 * Shown when the URL is index.php?page=updateDeleteContacts.
 * The table body starts empty. contacts.js Fetch-GETs the rows,
 * puts values in text inputs, and Fetch-POSTs update or delete per row.
 * There is no bulk Delete button. This view does not run SQL.
 *
 * data-mode="update" is how contacts.js knows to draw inputs plus Update/Delete
 * instead of the read-only List Contacts table.
 */
function init() {
    return <<<HTML
<div class="container mt-5">
  <!-- Loading, empty, success, and error sentences go here. -->
  <p id="listMessage"></p>
  <div id="contactsPanel">
    <!-- data-mode="update" tells contacts.js to draw text inputs plus Update/Delete. -->
    <table class="table table-striped table-bordered" id="contactsTable" data-mode="update">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Address</th>
          <th>State</th>
          <th>Zip</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Update</th>
          <th>Delete</th>
        </tr>
      </thead>
      <!-- JavaScript fills this tbody with inputs and buttons (renderContacts). -->
      <tbody id="contactsTableBody">
      </tbody>
    </table>
  </div>
</div>
<script src="js/contacts.js"></script>
HTML;
}
?>
