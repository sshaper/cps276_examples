<?php
$output = "";

if(isset($_POST['create'])){
$handle = fopen('appendfile.txt','a+');

$i = 0;

while($i < 3){
    fwrite($handle, "Hello Class <br>");
    $i++;
}

//I HAVE TO MOVE THE POINTER TO THE BEGING OF THE FILE BECAUSE IF I TRY TO READ IT NOW IT WILL SHOW NOTHING. SO I NEED TO USE THE REWIND METHOD
rewind($handle);

$output =  "<br><br>Contents of file is <br><br>".fread($handle, filesize('textfile.txt'));
}

if(isset($_POST['clear'])){
    $handle = fopen('appendfile.txt','w');
    fwrite($handle, "");
    $output = "<br><br>File has been cleared";
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Append Read File</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="public/css/main.css">
  </head>
  <body>
    <div id="wrapper" class="container">
      <h1>Append Read File</h1>
      <p>This example demostrates reading and appending a file plus clearing the contents of a file.</p>
      <form action="appendreadfile.php" method="POST">
        <input type="submit" class="btn btn-primary" name="create" value="Append to file">
        <input type="submit" class="btn btn-primary" name="clear" value="Clear file">
      </form>

      <p><?php echo $output; ?></p>
      
    </div>
    

  </body>
</html>


