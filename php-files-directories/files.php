<?php
/*
$handle = fopen("textfile.txt", "r" );

$text = "";

while (!feof( $handle)) {
    $text .= fread( $handle, 100)."<br><br>"; // READ 3 CHARS AT A TIME
}
echo $text; // Displays "Hello, world!"
fclose( $handle );*/





//$handle = fopen('textfile.txt','r');

//chmod('test.txt',0646);

//$write = fopen('test.txt','a+');

//fwrite($write,"hello");

//rewind($write);
//fclose($write);

//$write = fopen('test.txt','r');

//echo fread($write, 100);

//fclose($write);



//echo fread($handle,filesize('textfile.txt'));

//echo file_get_contents('https://www.wccnet.edu/');

$lines = file( "textfile.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
echo count($lines);
//foreach ( $lines as $line ) echo $line;

//echo fread($handle,99);

//echo "<br>";

//fgets($handle,1);

//echo "<br>";

//echo fpassthru($handle);

//fclose($handle);




?>