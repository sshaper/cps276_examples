<?php
/**
 * index.php — the HTML page shell
 *
 * The browser navigates here for screens (Welcome, Add, Delete).
 * Fetch for add/list/delete does NOT come here; it calls controllers/ directly.
 *
 * After the two requires, $nav and $content are ready to echo.
 */
require_once 'includes/navigation.php'; // sets $nav (navbar HTML)
require_once 'routes/router.php';       // sets $content (the chosen view HTML)

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
			/* Shared navigation from includes/navigation.php */
			echo $nav;
			
			/* HTML returned by the view's init() function */
			echo $content; 

		?>
	</body>
</html>
