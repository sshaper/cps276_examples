


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Form Examples</title>
</head>
<body style="padding: 30px;">




<form method="post" action="">

<label>Title <input type="text" size="5" name="firstname"></label>

<label for="address" >Address:</label>
<textarea id="address" name="address" cols="30" rows="4"></textarea>

<p>Color:</p>
<label><input type="radio" name="color" value="blue" > Blue</label>
<label><input type="radio" name="color" value="red" checked > Red</label>
<label><input type="radio" name="color" value="yellow" > Yellow</label>


<p>Size:</p>
<label><input type="radio" name="size" value="small" > Small</label>
<label><input type="radio" name="size" value="medium" checked > Medium</label>
<label><input type="radio" name="size" value="large" > Large</label>
    

<p>Sizes:</p>
<label><input type="checkbox" name="size" value="small" > Small</label>
<label><input type="checkbox" name="size" value="medium" checked > Medium</label>
<label><input type="checkbox" name="size" value="large" checked > Large</label>

<label for="color">Color:</label><br />

<select id="color" name="color" multiple size="3">
    <option value="blue">Blue</option>
    <option value="red" selected >Red</option>
    <option value="yellow">Yellow</option>
    <option value="purple">Purple</option>
    <option value="green">Green</option>
    <option value="pink">Pink</option>
</select>


<input type="file" name="somefile" size="30" >

<input type="hidden" name="destination" value="youremail@domain.com" >


<input type="button" name="submit" value="click me">




</form>
 
</div>
</body>
</html>