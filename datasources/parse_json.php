 <?php
/* GETS THE FILE THAT CONTAINS THE JSON CODE */
$str = file_get_contents('books.txt');

$i = 0;
$j = 0;
$bookObjList = '';
$bookArrList = '';

/* DECODES THE TEXT INTO AN OBJECT */
$json = json_decode($str);
while($i < count($json)){
	/* BECAUSE IT IS AN OBJECT WE HAVE TO USE THE ARROWS ->*/

	$bookObjList .= '<div><h2>'.$json[$i]->title.'<em> by '.$json[$i]->author.'</em></h2>';
	$bookObjList .= '<p>Published by: '.$json[$i]->publisher.'</p><ul>';
	$j = 0;
	
	while($j < count($json[$i]->editions)){
		$bookObjList .= '<li>Year: '.$json[$i]->editions[$j]->year.' - - Edition Number: '.$json[$i]->editions[$j]->edition.'</li>';
		$j += 1;
	}
	$bookObjList .= '</ul></div>';

	$i += 1;
}
$i = 0;

/* DECODES THE TEXT INTO AN ASSOCIATIVE ARRAY */
$json = json_decode($str, true);

while($i < count($json)){
	/* BECAUSE IT IS AN ASSOCIATIVE ARRAY WE HAVE TO USE THE BRACKET SYNTAX ['...'] */
	$bookArrList .= '<div><h2>'.$json[$i]['title'].'<em> by '.$json[$i]['author'].'</em></h2>';
	$bookArrList .= '<p>Published by: '.$json[$i]['publisher'].'</p><ul>';
	$j = 0;
	while($j < count($json[$i]['editions'])){
		$bookArrList .= '<li>Year: '.$json[$i]['editions'][$j]['year'].' - - Edition Number: '.$json[$i]['editions'][$j]['edition'].'</li>';
		$j += 1;
	}
	$bookArrList .= '</ul></div>';

	$i += 1;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Parsing JSON</title>
	<style>
		body{font: 100%/1.5 sans-serif;}
		h2 em{font-size: .5em; font-weight: normal}
		h2, p {margin: 0;}
		div{border: 4px double blue; padding: 5px; margin: 10px;}

	</style>
  </head>
  <body>
	<h1>Parsing using an Object</h1>
	<?php echo $bookObjList; ?>

	<h1>Parsing using an Associative array</h1>
	<?php echo $bookObjList; ?>
  </body>
</html>
