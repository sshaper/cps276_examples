<?php


if (isset($_POST["findLinks"])){
  $url = $_POST["url"];

  if (!preg_match('|^http(s)?\://|', $url)){
    $url = "http://$url";
  }

  $html = file_get_contents($url);
  
  preg_match_all("/<a\s*href=[‘\"](.+?)[‘\"].*?>/i", $html, $matches);

  $output = "<h2>Linked URLs found at " . htmlspecialchars($url). "</h2><ul>";

  for ($i = 0; $i < count($matches[1]); $i++) {
      $output .= "<li>" .htmlspecialchars($matches[1][$i]). "</li>";
  }

  $output .= "</ul>";
}

else {
  $output = "";
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Basic Form</title>
    <style>
      input[type="radio"]{margin: 0 10px 0 0;}
    </style>
  </head>
  <body>
    <main class="container">
      <h1>Enter a URL to scan:</h1>
      <form action="link_scraper.php" method="post">
        <div class="form-group">
          <label for="url">URL:</label>
          <input type="text" class="form-control" name="url" id="url">
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" name="findLinks" value="Find Links">
        </div>
      </form>
      <div><?php echo $output; ?></div>

    </main>
</body>
</html>