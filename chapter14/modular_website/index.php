<?php
require_once 'includes/navigation.php';
require_once 'routes/router.php';

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PHP Form Validation Example</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		
	</head>

	<body class="container">
		<?php
			/* This is the navigation  */
			echo $nav;
			
			/* This is the page content  */
			echo $content; 

		?>
	</body>
</html> 