<?php

$path = "index.php?page=welcome";


$nav=<<<HTML
    <nav>
        <ul>
            <li><a href="index.php?page=welcome">Welcome</a></li>
            <li><a href="index.php?page=addContact">Add Contact Information</a></li>
            <li><a href="index.php?page=deleteContacts">Delete contact(s)</a></li>
        </ul>
    </nav>
HTML;

if(isset($_GET)){
    if($_GET['page'] === "addContact"){
        require_once('pages/addContact.php');
        $result = init();
    }
    
    else if($_GET['page'] === "deleteContacts"){
        require_once('pages/deleteContacts.php');
        $result = init();
    }

    else if($_GET['page'] === "welcome"){
        require_once('pages/welcome.php');
        $result = init();

    }

    else {
        header('location: '.$path);
    }
}

else {
    header('location: '.$path);
}



?>