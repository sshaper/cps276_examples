<?php

// HELLO_WORLD.TXT CONTAINS THE CHARACTERS "HELLO, WORLD!"
$handle = fopen("textfile.txt", "r" );
$text = "";

while (!feof( $handle)) {
	$text .= fread( $handle, 300)."<br><br>";  // READ 300 CHARS AT A TIME
}

echo $text; 
fclose( $handle );
