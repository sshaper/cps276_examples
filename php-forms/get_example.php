<?php


if(isset($_GET['v1'])){
	$result = $_GET['v1'] + $_GET['v2'];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>PHP Get Example</title>
	</head>
	<body>
		<p>Get statements are good for passing info via a link.  In this example I will pass two numbers, add them, and display the result.</p>
		<p><a href="get_example.php?v1=1&amp;v2=5">ADD</a></p>
		<p>Results of the get statement <?php if(isset($result)){echo $result;} ?></p>
	</body>
</html>