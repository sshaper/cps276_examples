<?php
$loginStatus = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if (!empty($username) && !empty($password)) {
            if ($username === 'test' && $password === 'password') {
                header('Location: welcome.html');
            } else {
                header('Location: index.html');
            }
        } else {
            header('Location: index.html');
        }
    } else {
        header('Location: index.html');
    }
}

?>



