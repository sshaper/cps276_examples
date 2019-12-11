<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Validation Script</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/main.css">
   

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div id="wrapper" class="container">
      <p>This form uses ajax to validate the input on the backend. The advantage is you don't have to check is twice and it is checked on the backend no matter what anyone tries to do.  The disadvantage is you need JavaScript to do it.</p>

      <form>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="fname">First Name</label>
              <input type="text" class="form-control" id="fname" placeholder="First Name" value="Scott">
            </div> 
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="lname">Last Name</label>
              <input type="text" class="form-control" id="lname" placeholder="Last Name" value="Shaper">
            </div> 
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" class="form-control" id="address" placeholder="address" value="123 Someplace">
            </div> 
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="text" class="form-control" id="phone" placeholder="Phone Number" value="999-999-9999">
            </div> 
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control" id="email" placeholder="Email Address" value="sshaper@test.com">
            </div> 
          </div>
        </div>
       <button type="button" id="submitBtn" class="btn btn-primary">Submit</button>
      
    </div><!--  end wrapper -->
    <script src="public/js/main.js"></script>
  </body>
</html>