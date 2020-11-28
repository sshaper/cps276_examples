<?php
session_start();

/* DELETES THE COOKIE BY SETTING BACK ONE HOUR */
setcookie("PHPSESSID", "", time() - 3600, "/");

/* DELETE THE SESSION VALUES*/
session_destroy();

/* REDIRECT TO THE INDEX.PHP PAGE*/ 
header('Location: index.php');