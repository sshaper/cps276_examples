<?php

$xml = file_get_contents('../data/books.xml');
/*HAD TO SEND THE HEADER CONTENT TYPE BACK AS XML FOR THIS WORK.*/
header('Content-type: application/xml');
echo $xml;