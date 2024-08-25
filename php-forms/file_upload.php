<?php
if (isset( $_POST["sendPhoto"])){
	processFile();
}
else {
	$output = "";
}

function processFile(){
	// I PUT THE PHOTO INTO A DIRECTORY NAMED PHOTOS WHICH IS ALREADY ON THE SERVER AND HAS 777 FILE PERMISSIONS
	
	//I HAD TO MAKE $OUTPUT A GLOBAL VARIBLE SO IT COULD BE USED INSIDE AND OUTSIDE THIS FUNCTION
	global $output;
	
	//CHECK TO SEE IF A FILE WAS UPLOADED.  ERROR EQUALS 4 MEANS THERE WAS NO FILE UPLOADED
	if ($_FILES["photo"]["error"] == 4){
		$output = "No file was uploaded. Make sure you choose a file to upload.";
	}

	/*MAKE SURE THE FILE SIZE IS LESS THAN 1000000 BYTES.  THE ERROR EQUALS ONE MEANS THE FILE WAS TOO BIG ACCORDING TO THE SETINGS IN
	post_max_size LOCATED IN THE PHP INI FILE.*/
	elseif($_FILES["photo"]["size"] > 1000000 || $_FILES["photo"]["error"] == 1){
		$output = "The photo is too large";
	}

	//CHECK TO MAKE SURE IT IS THE CORRECT FILE TYPE IN THIS CASE JPEG OR PNG
	elseif ($_FILES["photo"]["type"] != "image/jpeg" && $_FILES["photo"]["type"] != "image/png") {

		$output = "<p>JPEG or PNG photos only, thanks!</p>";
	}

	//IF ALL GOES WELL MOVE FILE FROM TEMP LCOATION TO THE PHOTOS DIRECTORY 
	elseif (!move_uploaded_file( $_FILES["photo"]["tmp_name"], "photos/" . $_FILES["photo"]["name"])){
			$output = "<p>Sorry, there was a problem uploading that photo.</p>";
	}
	else {
		//IF ALL GOES WELL CALL DISPLAY THANKS METHOD	
		$output = displayThanks();
	}

}

function displayThanks() {

/*
NOTICE I USE THE POST SUPERGLOBAL ARRAY TO GET THE NAME AND NOT
THE FLES SUPERGLOBAL ARRAY.  ALL FILES USE $_FILES ALL TEXT ENTERIES USE $_POST
*/

return <<<HTML
	<h1>Thank You!</h1>
	
	<p>Thanks  {$_POST['visitorName']} for uploading your photo!</p>
	<p>Here's your photo:</p>
	<p><img src="photos/{$_FILES['photo']['name']}" alt="Photo"></p>

HTML;
	
}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Basic Form</title>
    
  </head>
  <body>
    <main class="container">
      <h1>Uploading a Photo</h1>
      <p>Please enter your name and choose a photo to upload, then click Send Photo.</p>
		<p>Example photos to try:<br>
			<a href="example_photos/mac_desktop.png">Photo that is too big</a><br>
			<a href="example_photos/mac-screenshot.png">Photo that should work.</a>
		</p>

      <form action="file_upload.php" method="post" enctype="multipart/form-data">
      	<div class="form-group">
      		<label for="visitorName">Your name</label>
      		<input type="text" class="form-control" name="visitorName" id="visitorName">
      	</div>
      	<div class="form-group">
      		<label for="photo">Your photo:</label>
      		<input type="file" name="photo" id="photo">
      	</div>
      	<div class="form-group">
      		<input type="submit" class="btn btn-primary" name="sendPhoto" value="Send Photo" />
      	</div>
		</form>

		<div> <?php echo $output; ?></div>
    </main>
</body>
</html>