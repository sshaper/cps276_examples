<?php
/* THIS ENTIRE PAGE IS JUST A PLACEHOLDER PAGE WHICH THE FORM WILL BE INJECTED INTO */


/*I REQUIRE IN THE FORM.PHP PAGE WHICH IS ACTUALLY DOES THE WORK.*/ 
require_once('php/form.php');

/*THE FORM.PHP PAGE HAS AN INIT FUNCTION THAT STARTS EVERYTING SO I CALL THAT.  THE RESULT VARIABLE CONTAINS WHATEVER WAS RETURNED FROM THE FORM PAGE.*/
$result = init();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PHP Form Validation Example</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		
	</head>

	<body class="container">
		<h1>PHP Sticky form with Validation</h1>
		<?php
			/* THE ACKNOWLEDGEMENT GOES HERE AS THE FIRST INDEX OF THE ARRAY  */
			echo $result[0]; 

			/* THE FORM GOES HERE.  LOOK AT THE FORM.PHP PAGE TO SEE HOW THE RETURN IS DONE. */
			echo $result[1]; 
		?>
	</body>
</html> 