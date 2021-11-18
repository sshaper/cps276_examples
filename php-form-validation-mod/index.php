<?php
/* THIS ENTIRE PAGE IS JUST A PLACEHOLDER PAGE WHICH THE FORM WILL BE INJECTED INTO */
/*I REQUIRE IN THE ROUTES PAGE WHICH IS ACTUALLY DOES THE WORK FOR GETTING THE PAGES.*/ 
require_once('pages/routes.php');

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PHP Form Validation Example</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		
	</head>

	<body class="container">
		<?php
			/* THIS IS THE PHP PAGE  */
			echo $nav;
			
			/* THE ACKNOWLEDGEMENT GOES HERE AS THE FIRST INDEX OF THE ARRAY  */
			echo $result[0]; 

			/* THE FORM GOES HERE.  LOOK AT THE FORM.PHP PAGE TO SEE HOW THE RETURN IN DONE. */
			echo $result[1]; 
		?>
	</body>
</html> 