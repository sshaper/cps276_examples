<?php
/*THIS GETS THE DATA IN THIS CASE JUST THE FILE NAME*/
$data = $_POST['filename'];

/*THIS IS THE ACTUAL FILE THAT WAS SENT.*/
$file = $_FILES['file'];

echo "<p>The follow are associative arrays of the appended items.</p>";
echo "<p>Filename is ".$data. "</p>";


echo "<p>File</p>";
echo '<pre>';
print_r($file);
echo "</pre>";

echo "<p>Using the associative array names you can get the individual parts.  For example:</p>";

echo '<p>$file[\'size\'] will get the file size which is '.$file['size'].' bytes.</p>';

