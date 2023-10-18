<?php

$handle = fopen('textfile.txt','r');

echo fread($handle, 1000);//THIS WILL READ THE FIRST 1000 CHARACTERS

//THIS WILL READ FROM THE POINTER POSITOIN OF 1001 TO THE END OF THE FILE.  IT IS IMPORTANT TO REMBER WHERE THE FILE POINTER IS WHEN READING FILE.
echo "<br><br>".fread($handle, filesize('textfile.txt'));

