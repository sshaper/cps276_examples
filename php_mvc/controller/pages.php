<?php
require_once 'controller/crud.php';
require_once 'classes/Page.php';

function homePage(){
	$nameList = getNames('list');
	$page = new Page();

	$pageData['title'] = "Home Page";
	$pageData['heading'] = "Home Page";
	$pageData['nav'] = $page->nav();
	$pageData['content'] = require_once 'views/home.php';
	$pageData['js'] = "";
	return $pageData;
}

function addNamePage(){
	$nameList = getNames('list');
	$page = new Page();

	$pageData['title'] = "Add Name Page";
	$pageData['heading'] = "Add Name Page";
	$pageData['nav'] = $page->nav();
	$pageData['content'] = require_once 'views/add_names.php';
	$pageData['js'] = "<script src='public/js/main.js'></script>";
	return $pageData;
}

function updateDeleteNamePage(){
	$nameList = getNames('input');
	$page = new Page();

	$pageData['title'] = "Update Delete Page";
	$pageData['heading'] = "Update Delete Page";
	$pageData['nav'] = $page->nav();
	$pageData['content'] = require_once 'views/update_delete_name.php';
	$pageData['js'] = "<script src='public/js/main.js'></script>";
	return $pageData;
}

?>