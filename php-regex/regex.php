<?php

$regex = "/Scott/";

//PREG_OFFSET_CAPTURE

//echo preg_match( $regex, "Scott Scott Scott",$matches, PREG_OFFSET_CAPTURE);

preg_match( "/P.*/", "Peter Piperea", $matches );

preg_match( "/P*/", "Peter Piperea", $matches );


//echo preg_match_all($regex, "Scott Scott Scott");

echo "<pre>";
print_r($matches);

//echo $matches[0][1]


?>