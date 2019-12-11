<?php
session_start();
/* DELETE THE SESSION VALUES*/
session_unset();

header('Location: index.php');