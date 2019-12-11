<?php
session_start();
/* DELETE THE SESSION VALUES*/
session_destroy();
header('Location: index.php');