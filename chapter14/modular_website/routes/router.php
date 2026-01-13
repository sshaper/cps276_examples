<?php

$path = "index.php?page=welcome";


if(isset($_GET)){
    if($_GET['page'] === "addContact"){
        require_once('views/addContactView.php');
        $content = init();
    }
    
    else if($_GET['page'] === "deleteContacts"){
        require_once('views/deleteContactView.php');
        $content = init();
    }

    else if($_GET['page'] === "welcome"){
        require_once('views/welcome.php');
        $content = init();

    }

    else {
        header('location: '.$path);
    }
}

else {
    header('location: '.$path);
}
?>