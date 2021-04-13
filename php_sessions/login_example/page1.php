<?php

session_start();
if($_SESSION['access'] !== "accessGranted"){
  header('Location: index.php');
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Page 1</title>
    
  <!--below is a script which allows IE 8 to understand HTML 5 elements.-->
  <!--[if lt IE 9]>
      <script>
        var elementsArray = ['abbr', 'article', 'aside', 'audio', 'bdi', 'canvas', 'data', 'datalist', 'details', 'figcaption', 'figure', 'footer', 'header', 'main', 'mark', 'meter', 'nav', 'output', 'progress', 'section', 'summary', 'template', 'time', 'video'];
        var len = elementsArray.length;
        for(i = 0; i < len; i++){
          document.createElement(elementsArray[i]);
        }
      </script>
  <![endif]-->

  <!--CSS style sheet goes here-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/main.css">
  </head>
  <body>
  <div id="wrapper">
    <header>
      <h1>Page 1</h1>
    </header>
    <nav>
      <ul>
        <li><a href="page1.php">Page 1</a></li>
        <li><a href="page2.php">Page 2</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
    <main>
      <p>Hello <?php echo $_SESSION['fname']; ?></p>
      <p>This is page 1</p>

    </main>
    
  </div>
  </body>
</html>