<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Form Examples</title>
</head>
<body>
    <div class="container">
    <form method="GET" action="index.php">

    <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Email address</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
</div>


    <label for="firstName">Enter your name: </label><br>
        
    <input id="firstName" type="text" value="Scott" name="fname" disabled><br>



    <br>

    <p>Color:</p>
        <label><input type="radio" name="color" value="#0000FF" > Blue</label>
        <label><input type="radio" name="color" value="red" > Red</label>
        <label><input type="radio" name="color" value="yellow" > Yellow</label>

        <p>Size:</p>
        <label><input type="radio" name="size" value="small" > Small</label>
        <label><input type="radio" name="size" value="medium" checked > Medium</label>
        <label><input type="radio" name="size" value="large" > Large</label><p>Sizes:</p>

        <br>
        <label><input type="checkbox" name="size[]" value="small" > Small</label>
        <label><input type="checkbox" name="size[]" value="medium" > Medium</label>
        <label><input type="checkbox" name="size[]" value="large" checked > Large</label>

        <br>

        <label for="color">Color:</label><br />
        <select id="color" name="color" >
            <option value="blue">Blue</option>
            <option value="red">Red</option>
            <option value="yellow">Yellow</option>
            <option value="purple">Purple</option>
            <option value="green">Green</option>
            <option value="pink">Pink</option>
        </select>

        <br>

        <input type="file" name="somefile" size="30" >

        <input type="hidden" name="destination" value="youremail@domain.com" >
        


<br>
    <input type="submit" value="click me">

    <input type="reset" value="reset">

    <input type="button" value="generic" >


    </form>
</div>
</body>
</html>