<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['showName'])) {
        header("Location: welcome.php?name=" . urlencode($_POST['name']));
        exit();
    } elseif (isset($_POST['dontShowName'])) {
        header("Location: welcome.php");
        exit();
    }
}

?>



