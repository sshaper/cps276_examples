<?php
require_once 'controllers/deleteContact.php';

function init() {
    global $records, $msg, $deleted;

    if ($records === "error") {
        return "<p class='text-danger'>Could not display records</p>";
    }

    if (!is_array($records) || count($records) === 0) {
        return "<p></p><p>There are no records to display</p>";
    }

    $output = <<<HTML
<form method='post' action='index.php?page=deleteContacts'>
  <input type='submit' class='btn btn-danger' name='delete' value='Delete'/><br><br>
  <table class='table table-striped table-bordered'>
    <thead>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Address</th>
        <th>State</th>
        <th>Zip</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
HTML;

    foreach ($records as $row) {
        $output .= "<tr>
            <td>" . htmlspecialchars($row['firstName']) . "</td>
            <td>" . htmlspecialchars($row['lastName']) . "</td>
            <td>" . htmlspecialchars($row['address']) . "</td>
            <td>" . htmlspecialchars($row['state']) . "</td>
            <td>" . htmlspecialchars($row['zip']) . "</td>
            <td>" . htmlspecialchars($row['phone']) . "</td>
            <td>" . htmlspecialchars($row['email']) . "</td>
            <td><input type='checkbox' name='chkbx[]' value='" . htmlspecialchars((string)$row['id']) . "' /></td>
        </tr>";
    }

    $output .= "</tbody></table></form>";

    if ($deleted) {
        $msg = "<p class='text-success'>Contact(s) deleted</p>";
    } else {
        $msg = "<p>&nbsp;</p>";
    }

    return $msg . $output;
}
?>
