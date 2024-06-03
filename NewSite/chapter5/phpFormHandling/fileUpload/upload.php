<?php
$uploadStatus = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['fileName'])) {
        $uploadStatus = "No file name given.";
    } else {
        $uploadStatus = "File Name is {$_POST['fileName']}.<br>";
        if (isset($_FILES["fileSelectField"])) {
            $file = $_FILES["fileSelectField"];
           
            // Check file size
            if ($file["size"] > 1000000 || $file["error"] == 1) {
                $uploadStatus .= "File is too large.";
            } else {
                // Check MIME type
                $fileType = mime_content_type($file["tmp_name"]);
                if ($fileType != "image/png" && $fileType != "image/jpeg" && $fileType != "image/gif") {
                    $uploadStatus .= "Only PNG, JPEG, and GIF images are allowed.";
                } else {
                    // File checks passed
                    if (move_uploaded_file($file["tmp_name"], "uploads/{$_POST['fileName']}.png")) {
                        $uploadStatus .= "File was successfully uploaded.";
                        // Display image on webpage
                        $uploadStatus .= "<img src=\"uploads/{$_POST['fileName']}\">";

                    } else {
                        $uploadStatus .= "There was a problem uploading your file - please try again.";
                    }
                    
                }
            }
        } else {
            $uploadStatus .= "No file uploaded or there was an upload error.";
        }
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>File Upload Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="container">
<h1>File Upload</h1>    
<p>Upload Status:<br> <?php echo $uploadStatus; ?></p>
</body>
</html>