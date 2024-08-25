<?php

$handle = fopen("textfile.txt", "r" );
$text = "";

while (!feof( $handle)) {
	$text .= fread( $handle, 300)."<br><br>";  // READ 300 CHARS AT A TIME UNTIL IT REACHES THE END OF THE FILE
}

echo $text; 
fclose( $handle );
