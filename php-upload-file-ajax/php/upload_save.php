<?php
/*THIS GETS THE DATA IN THIS CASE JUST THE FILE NAME*/
$data = $_POST['filename'];

/*THIS IS THE ACTUAL FILE THAT WAS SENT.*/
$file = $_FILES['file'];
$filename = $file['name'];

if($file['size'] < 100000){
	if(move_uploaded_file($file['tmp_name'], '../uploadedfile/'.$file['name'])){
		
		/* IT IS VERY IMPORTANT TO MAKE SURE YOU HAVE DOUBLE QUOTES AROUND THE PROPERTY NAME AND VALUE, OTHERWISE YOU WILL GET PARSE ERRORS IN YOUR JSON PARSE ON THE JAVASCRIPT END*/
		
$txt = <<<TXT
[{"filename":"$filename", "filepath": "uploadedfile/$filename"}]
TXT;

		/* IN THIS SITUATION I SAVED THE FILE TO A TEXT FILE BUT I COULD HAVE JUST AS EASILY SAVED IT TO A DATABASE.*/
		$datafile = fopen('../data_file/datafile.txt', 'w');
		fwrite($datafile, $txt);
		fclose($datafile);
		$content = file_get_contents('../data_file/datafile.txt');
		echo "success^^^".$content;
	}	
}
else {
	echo 'error^^^File is too big';
}
