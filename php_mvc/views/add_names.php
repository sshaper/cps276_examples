<?php

$page = <<<HTML
<main>
  <p>Fill out all the fields and click the "Add Name" button.</p>
  <p id="result"></p>

  
  <div class="row">
    <div class="col-md-3">
      <label for="fname">First Name</label>
      <input type="text" class="form-control" placeholder="first name" id="fname" name="fname" value="Scott">
    </div>
    <div class="col-md-3">
      <label for="lname">Last Name</label>
      <input type="text" class="form-control" placeholder="last name" id="lname" name="lname" value="Shaper">
    </div> 
  </div>
  <div class="row">
    <div class="col-md-2">
      <label for="color">Eye Color</label>
      <input type="text" class="form-control" placeholder="eye color" id="color" name="color" value="blue">
    </div>
    <div class="col-md-2">
      <label for="gener">Gender</label>
      <input type="text" class="form-control" placeholder="gender" id="gender" name="gender" value="male">
    </div>
    <div class="col-md-2">
      <label for="state">State</label>
      <input type="text" class="form-control" placeholder="state" id="state" name="state" value="mi">
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <input type="button" class="btn btn-primary" name="addName" id="addName" value="Add Name">
    </div>
  </div>
 
</main>

HTML;

return $page;


?>
