<?php
/**
 * index.php — HTML page shell for every screen
 *
 * The browser loads this file for pages (Welcome, List, Add, Update/Delete).
 * Fetch for add/list/update/delete does NOT come here; it calls controllers/ directly.
 *
 * navigation.php sets $nav (the shared menu).
 * router.php sets $content (HTML from the chosen view's init() function).
 *
 * This example has no login. The final project adds sessions and staff vs admin.
 */
require_once 'includes/navigation.php'; // sets $nav
require_once 'routes/router.php';       // sets $content

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Modular Contacts Example</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!-- Bootstrap is loaded once here so views do not repeat the full document. -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		
	</head>

	<body class="container">
		<?php
			echo $nav;
			echo $content;
		?>
	</body>
</html>
