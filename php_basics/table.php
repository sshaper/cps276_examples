<?php
   $output = "Shaper, Scott\nShaper, Karen\n";
     
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Classform</title>
  </head>
  <body>
    <div class="container"> 
      <h1>Add Names</h1>
      <form action="listname.php" method="post" class="row g-2">
    <div class="col-2">            
          <div class="row">
              <div class="col-6">
              <input type="submit" class="btn btn-primary" name="submit" value="Add Name" /> 
              </div>

              <div class="col-6">
              <input type="submit" class="btn btn-primary" name="reset" value="Clear Name" /> 
              </div>
          </div>
       </div>
      
       <div class="Entername">
        <label for="Entername" class="form-label">Enter name</label>
        <input type="text" class="form-control" name="nameinput" id="Entername">
     </div>
  
     <div class="form-List of Names">
        <label for="comments" class="form-label">List of Names</label>
        <textarea style="height:500px" name="comments" class="form-control" id="comments" ><?php echo $output; ?></textarea>
      </div>

  </form>
  </body>
</html>