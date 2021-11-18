<?php
function init(){

    require_once 'classes/Pdo_methods.php';

    if(isset($_POST['delete'])){
        if(isset($_POST['chkbx'])){
            $error = false;
            foreach($_POST['chkbx'] as $id){
                $pdo = new PdoMethods();

                $sql = "DELETE FROM contactMod WHERE id=:id";
                
                $bindings = [
                    [':id', $id, 'int'],
                ];


                $result = $pdo->otherBinded($sql, $bindings);

                if($result === 'error'){
                    $error = true;
                    break;
                }
            }
        }
    }
    
    $output = "";
    
    $pdo = new PdoMethods();

    /* HERE I CREATE THE SQL STATEMENT I AM BINDING THE PARAMETERS */
    $sql = "SELECT * FROM contactMod";

    $records = $pdo->selectNotBinded($sql);

    if(count($records) === 0){
        $output = "<p>There are no records to display</p>";
        return [$output,""];
    }
    else {
        $output = "<form method='post' action='index.php?page=deleteContacts'>";
        $output .= "<input type='submit' class='btn btn-danger' name='delete' value='Delete'/><br><br><table class='table table-striped table-bordered'>
    <thead>
        <tr>
        <th>Name</th>
        <th>Phone</th>
        <th>State</th>
        <th>Financial</th>
        <th>Eye Color</th>
        <th>Email</th>
        </tr>
    </thead><tbody>";

    foreach($records as $row){
        $output .= "<tr><td>{$row['name']}</td>
        <td>{$row['phone']}</td>
        <td>{$row['state']}</td>
        <td>{$row['financial']}</td>
        <td>{$row['eye']}</td>
        <td><input type='checkbox' name='chkbx[]' value='{$row['id']}' /></td></tr>";
    }

    $output .= "</tbody></table></form>";

    if(isset($error)){
        if($error){
            $msg = "<p>Could not delete the contact(s)</p>";
        }
        else {
            $msg = "<p>Contact(s) deleted</p>";
        }
    }
    else {
        $msg="";
    }
    return [$msg, $output];
    }
}