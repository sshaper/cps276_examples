<?php

require_once 'classes/Pdo_methods.php';
$pdo = new PdoMethods();

$msg = "<p>&nbsp;</p>";
$output = "";
$deleted = false;

if (isset($_POST['delete'])) {
    if (isset($_POST['chkbx'])) {
        foreach ($_POST['chkbx'] as $id) {
            $sql = "DELETE FROM contactMod WHERE id=:id";
            $bindings = [
                [':id', $id, 'int'],
            ];
            $result = $pdo->otherBinded($sql, $bindings);

            if ($result === 'error') {
                $msg = "<p class='text-danger'>There was a problem deleting this record.</p>";
                break;
            }
            $deleted = true;
        }
    }
}

$sql = "SELECT * FROM contactMod";
$records = $pdo->selectNotBinded($sql);
