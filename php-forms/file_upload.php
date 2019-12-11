<?php
if (isset( $_POST["sendPhoto"])){
	processFile();
}
else {
	$output = "";
}

function processFile(){
	
	/* I HAVE TO USE THE GLOBAL SO THAT OUTPUT CAN BE USED OUTSIDE OF THE PROCESSFILE FUNCTION*/
	global $output;
	if (!is_dir('photos')){
		mkdir('photos');
		chmod('photos',0777);
	}

	if (isset($_FILES["photo"]) and $_FILES["photo"]["error"] == UPLOAD_ERR_OK ){

		if ($_FILES["photo"]["type"] != "image/jpeg" && $_FILES["photo"]["type"] != "image/png") {

			$output = "<p>JPEG or PNG photos only, thanks!</p>";
		}

		else if (!move_uploaded_file( $_FILES["photo"]["tmp_name"], "photos/" . basename($_FILES["photo"]["name"]))){
			$output = "<p>Sorry, there was a problem uploading that photo.</p>" .$_FILES["photo"]["error"] ;
		}

		else {
			$output = displayThanks();
		}

	}
	else {
			switch( $_FILES["photo"]["error"] ) {
				case UPLOAD_ERR_INI_SIZE: $message = "The photo is larger than the server allows.";break;
				case UPLOAD_ERR_FORM_SIZE: $message = "The photo is larger than the script allows.";break;
				case UPLOAD_ERR_NO_FILE: $message = "No file was uploaded. Make sure you choose a file to upload.";break;
				default: $message = "Please contact your server administrator for help.";
			}

			$output = "<p>Sorry, there was a problem uploading that photo. $message</p>";
	}

}

function displayThanks() {

$ack = <<<HTML
	<h1>Thank You</h1>
	<p>Thanks for uploading your photo! {$_POST['visitorName']}</p>

	<p>Here's your photo:</p>
	<p><img src="photos/{$_FILES['photo']['name']}" alt="Photo"></p>

HTML;

	return $ack;
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
    <style>
      input[type="radio"]{margin: 0 10px 0 0;}
    </style>
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