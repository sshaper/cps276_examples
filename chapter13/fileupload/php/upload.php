<?php
$error = false;
$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
        
    $file = $_FILES['file'];
    $fileName = $_POST['fileName'].".png";

    // Specify the directory where you want to save the uploaded files.  I created this directory on the server and gave it 777 permission.
    $uploadDirectory = '../uploads/';

    
    // Path to save the uploaded file
    $uploadFilePath = $uploadDirectory . $fileName;

    // Move the uploaded file to the specified directory
    if (move_uploaded_file($file['tmp_name'], $uploadFilePath)) {
        $error = false;
        $msg = "File uploaded successfully";
    } else {
        $error = true;
        $msg = "Failed to upload file";
    }
} else {
    $error = true;
    $msg =  "No file uploaded.";
}

//truncate the ../
$uploadFilePath = substr($uploadFilePath, 3);


$status = [
    "error" => $error,
    "msg" => $msg,
    "path" => $uploadFilePath,
    "fileName" => $fileName
];

header('Content-Type: application/json');
echo json_encode($status);

?>