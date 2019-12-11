<?php
/* FIRST I CREATE A NEW DOM DOCUMENT */
$xml = new DOMDocument();

/* THEN I LOAD THE FILE*/
$xml->load('books.xml');

/* THE DOMDOCUMENT IS A BIT MORE CUMBERSOME BECAUSE IT NEEDS TO GET ELEMENTS BY THE TAG NAME, THE ADVANTAGE IS THE DOMDOCUMENT IS MUCH MORE POWERFUL THEN THE SIMPLEXML OBJECT, THOUGH IN THESE EXAMPLES IT APPEARS TO BE SIMULAR. */
$books = $xml->getElementsByTagName('book');
$i = 0;
$j = 0;
$bookList = '';

/* THE DOMDOCUMENT USES THE LENGTH PROPERTY INSTEAD OF THE COUNT METHOD OF SIMPLEXML */
while($i < $books->length){
	$bookList .= '<div>';
	$bookList .= '<h1>'.$books[$i]->getElementsByTagName('title')[0]->nodeValue;

	/* NOTICE TO DISPLAY ATTRIBUTES YOU NEED TO USE THE ->ATTRIBUTES['ATTRIBUTE NAME']*/
	$bookList .= '<em> by '.$books[$i]->getElementsByTagName('title')[0]->attributes['author']->value.'</em></h1>';
	
	$bookList .= '<p>Published By '.$books[$i]->getElementsByTagName('publisher')[0]->nodeValue.'</p>';
	
	$editions = $books[$i]->getElementsByTagName('edition');
	$j = 0;
	$bookList .= '<p>Editions</p><ul>';
	while($j < $editions->length){
		$bookList .= '<li> Year: '.$editions[$j]->attributes['year']->value;
		$bookList .= ' -- Edition Number: '.$editions[$j]->nodeValue.'</li>';
		$j += 1;
	}


	$bookList .= '</ul></div>';
	$i += 1;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Parsing DOM XML</title>
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