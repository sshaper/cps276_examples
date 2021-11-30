<?php
if (isset($_GET['file'])){
	$page = $_GET['file'];
}

else {
	$page = "homePage";
}
	
switch($page){
	case "homePage" : require_once 'controller/pages.php'; $pageData = homePage(); break;
	case "addNamePage" : require_once 'controller/pages.php'; $pageData = addNamePage(); break;
	case "updateDeleteNamePage" : require_once 'controller/pages.php'; $pageData = updateDeleteNamePage(); break;
	default : require_once 'controller/pages.php'; $pageData = homePage(); break;
}
