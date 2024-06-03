<?php

$path = "index.php?page=welcome";


if(isset($_GET)){
    if($_GET['page'] === "addContact"){
        require_once('pages/contactForm.php');
        $content = init();
    }
    
    else if($_GET['page'] === "deleteContacts"){
        require_once('pages/delete.php');
        $content = init();
    }

    else if($_GET['page'] === "welcome"){
        require_once('pages/welcome.php');
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