<?php

/* LOAD THE FILE AND CREATE AN OBJECT*/
$books = simplexml_load_file('books.xml');
$i = 0;
$j = 0;
$bookList = '';

/* LOOP THROUGH THE BOOK NODES.
IN THIS EXAMPLE I JUST WALK THROUGH ALL THE NODES AND SUBNODES AND DISPLAY THE INFORMATION IN A DIFFERENT FORMAT
*/

while($i < $books->count()){
	$bookList .= '<div>';
	/* EACH NODE IS SEPERATED BY A -> AND THE ATTRIBUTES ARE ASSOCIATIVE ARRAYS ELEMENT['ATTRIBUTE'] */
	$bookList .= '<h1>'.$books->book[$i]->title.'<em>'.$books->book[$i]->title['author'].'</em></h1>';
	$bookList .= '<p>Published By '.$books->book[$i]->publisher.'</p>';
	
	$j = 0;
	$bookList .= '<p>Editions</p><ul>';
	while($j < $books->book[$i]->editions->edition->count()){
		$bookList .= '<li> Year: '.$books->book[$i]->editions->edition[$j]['year'];
		$bookList .= ' -- Edition Number: '.$books->book[$i]->editions->edition[$j].'</li>';
		$j += 1;
	}


	$bookList .= '</ul></div>';
	$i += 1;
}

/* IN THE HTML BELOW I DISPLAY THE DATA FROM THE XML FILE.*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Parsing SimpleXML</title>
	<style>
		body{font: 100%/1.5 sans-serif;}
		h1 em{font-size: .5em; font-weight: normal}
		h1, p {margin: 0;}
		div{border: 4px double blue; padding: 5px; margin: 10px;}
	</style>
  </head>
  <body>
	<?php echo $bookList; ?>
  </body>
</html>