<?php
/*INCLUDE FILES*/
include_once('classes/Validation.php');

$acknowledgement = "&nbsp;";
$output = "";


/*IF THE "ADD NAME TO FILE" BUTTON WAS CLICK THE FOLLOWING IS DONE.*/
if (isset($_POST['write'])){
	/*
	ANYTHING CREATED OUTSIDE THE FUNCTION MUST BE GLOBAL TO BE USED INSIDE A FUNCTION.
    OR PASSED VIA THE PARAMETER. ALSO ANY VARIABLES CREATED INSIDE THE FUNCTION THAT ARE
    SET AS GLOBAL CAN BE USED OUTSIDE THE FUNCTION.
    */
    global $errorArray;
    /*GLOBAL $VALIDATION;
    INITIATE OBJECT OF THE VALIDATION CLASS*/
    $Validation = new Validation();
    
    /*THIS CHECKS THE ENTRY AND IF THERE IS AN ERROR PUTS THE ERROR MESSAGE INTO THE ERRORARRAY
    NOTE: TO AVOID WRITING THE $_POST[] YOU COULD ASSIGN EACH POST TO A VARIABLE.*/
    $errorArray[0] = $Validation->checkForBlanks($_POST['fname']);
    $errorArray[1] = $Validation->checkForBlanks($_POST['lname']);
    
    /*
    IF EVERYTHING CHECKS OUT I OPEN A FILE AND SET IT TO "A" WHICH MEANS APPEND. WHAT I WANT TO DO IS APPEND MY CONTENT
    TO THE END OF THE EXISTING FILE CONTENT.  IN THIS EXAMPLE I HAVE A LIST OF NAMES AND EVERY NAME I ADD NEEDS TO GO TO
    THE BOTTOM OF THE NAMES LIST.  WHEN THAT STEP IS COMPLETE I CLEAR OUT THE NAME VARIABLES SO THEY DO NOT STAY IN THE TEXT
    BOXES AFTER THE NAME HAS BEEN WRITTEN.  ALSO, I ADD SOME TEXT TO THE ACKNOWLEDGMENT SO THE USER SEES THAT THE NAME WAS ADDED.
    */
    if (!$Validation->checkErrors()){
    	/*
    	I DO THIS TO CREATE A CSV (COMMA SEPERATED VALUES) STRUCTURE.  EACH VALUE IS SEPERATED BY A COMMA AND ENDS WITH A LINE BREAK
    	(\N)
    	*/
    	$content = $_POST['fname'].",".$_POST['lname']."\n";
    	$file = fopen("files/names.txt","a") or die("Cannot Open File");
    	fwrite($file,$content);
    	fclose($file);

    	/*I CLEAR MY POST VALUES BECAUSE I USED THOSE BELOW IN THE HTML*/
    	$_POST['fname'] = "";
    	$_POST['lname'] = "";

    	/*CREATE MY ACKNOWLEDGEMENT*/
    	$acknowledgement = "Name has been added";
    	
    }
}

/*IF THE "READ FILE" BUTTON IS CLICKED THE FOLLOWING IS DONE.

I FIRST GET THE CONTENTS OF THE FILE USING THE FILE() FUNCTION. THAT FUNCTION READS THE ENTIRE FILE AND PUTS EACH LINE INTO AN ARRAY.
I LOOP THROUGH THE ARRAY (CALLED $FILE) AND EXPLODE ON EACH COMMA CREATING A $TEMPARR OF EACH LINE.  I THEN REMOVE THE EXTRA SPACE FROM
THE LAST NAME AND PUT THE LAST NAME FIRST, THEN A COMMA AND SPACE, AND THE FIRST NAME INTO ANOTHER ARRAY NAMED $SORTEDARR.  NOW I HAVE AN
ARRAY THAT HAS THE LASTNAME, FIRSTNAME FORMAT.  I SORT THAT ARRAY, THEN LOOP THROUGH IT PUTTING EACH LINE INTO THE $OUTPUT VARIABLE. THE
RESULT IS A LIST OF NAMES, SORTED BY LASTNAME THEN FIRST NAME.
 

THERE ARE OTHER WAYS OF DOING THIS. I COULD HAVE JUST ENTERED THE NAMES INTO THE FILE USING THE LAST NAME FIRST FORMAT.  BUT THIS IS AN
EXAMPLE SHOWING HOW YOU CAN CHANGE STRUCTURES.*/

if (isset($_POST['read'])){
	$sortedArr = array();
	$file = file("files/names.txt");
	foreach($file as $v){
		$tempArr = explode(",",$v);
		
		/*THE \N CREATES AN EXTRA SPACE AT THE END OF THE LAST NAME, THIS REMOVES IT.*/
		$tempArr[1] = substr($tempArr[1],0,-1);
		$str = "$tempArr[1], $tempArr[0]";
		array_push($sortedArr,$str);
	}
	/*FOR SORTING LOWER CASE*/
	usort($sortedArr,"strcasecmp");
	
	/*FOR JUST SORTING
	SORT($SORTEDARR);*/
	foreach($sortedArr as $v){
		$output .= "<p>$v</p>";
	}
	
}
/*
THIS IS VERY SIMPLE WAY TO CLEAR A FILE. I OPEN THE FILE WITH THE "W" FLAG (WHICH MEANS WRITE OR OVERWRITE IF THE FILE HAS CONTENT), 
THEN I WRITE AN EMPTY STRING.
*/
if (isset($_POST['clear'])){
	$file = fopen("files/names.txt","w") or die ("Cannot Open File");
	fwrite($file,"");
	fclose($file);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Contacts</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
<!--
.error{color: red; font-size: 11px;} 
-->
</style>
</head>
<body>
<p><?php  echo $acknowledgement; ?></p>
<form method="post" action="" >
		<p><label for="fname">First Name</label><?php if(isset($errorArray[0])){echo "<span class='error'>{$errorArray[0]}</span>";} ?><br />
		<input type="text" id="fname" name="fname" tabindex="10" value="<?php if(isset($_POST['fname'])){echo $_POST['fname'];} ?>" /></p>
		
		<p><label for="lname">Last Name</label><?php if(isset($errorArray[1])){echo "<span class='error'>{$errorArray[1]}</span>";} ?><br />
		<input type="text" id="lname" name="lname" tabindex="20" value="<?php if(isset($_POST['lname'])){$_POST['lname'];} ?>" /></p>

		<p>
		<input type="submit" name="write" value="Add Name To File" tabindex="30" />
		<input type="submit" name="read" value="Read File" tabindex="40" />
		<input type="submit" name="clear" value="Clear File" tabindex="50" />
		</p>
	</form>
	<?php echo $output; ?>
</body>
</html>

	
