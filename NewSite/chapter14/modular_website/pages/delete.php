<?php
require_once 'modules/deleteContact.php';

function init(){
    global $records, $msg, $deleted;
    if(count($records) === 0){
        $msg = "<p></p>";
        $output = "<p>There are no records to display</p>";
    }
    else {
        $output = <<<HTML

        <form method='post' action='index.php?page=deleteContacts'>
            <input type='submit' class='btn btn-danger' name='delete' value='Delete'/><br><br><table class='table table-striped table-bordered'>
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
        <tbody>

HTML;

        foreach($records as $row){
            $output .= "<tr><td>{$row['firstName']}</td>
            <td>{$row['lastName']}</td>
            <td>{$row['address']}</td>
            <td>{$row['state']}</td>
            <td>{$row['zip']}</td>
            <td>{$row['phone']}</td>
            <td>{$row['email']}</td>
            <td><input type='checkbox' name='chkbx[]' value='{$row['id']}' /></td></tr>";
        }

        $output .= "</tbody></table></form>";

        if($records == "error"){
            $msg = "<p style='color:red'>Could not display records</p>";
        }
        else {
            if(!$deleted){
                $msg = "<p>&nbsp;</p>";
            }
            else {
                $msg = "<p style='color: green'>Contact(s) deleted</p>";
            }
            
        }
        
    }

    return $msg.$output;
}