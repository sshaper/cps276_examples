<?php
// Initialize variables for error handling and messages
$error = false;
$msg = "";

// Check if the request is a POST and if a file was uploaded
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    // Get the uploaded file information
    $file = $_FILES['file'];
    // Create the filename by appending .png to the provided name
    $fileName = $_POST['fileName'].".png";

    // Define the upload directory (must exist and have proper permissions)
    $uploadDirectory = '../uploads/';

    // Create the full path where the file will be saved
    $uploadFilePath = $uploadDirectory . $fileName;

    // Attempt to move the uploaded file from temporary location to target directory
    if (move_uploaded_file($file['tmp_name'], $uploadFilePath)) {
        $error = false;
        $msg = "File uploaded successfully";
    } else {
        $error = true;
        $msg = "Failed to upload file";
    }
} else {
    // Handle case where no file was uploaded
    $error = true;
    $msg =  "No file uploaded.";
}

// Remove the '../' from the path for display purposes
$uploadFilePath = substr($uploadFilePath, 3);

// Prepare the response data
$status = [
    "error" => $error,      // Boolean indicating success/failure
    "msg" => $msg,          // Message describing the result
    "path" => $uploadFilePath,  // Path to the uploaded file
    "fileName" => $fileName     // Name of the uploaded file
];

// Set the response header to JSON
header('Content-Type: application/json');
// Send the response as JSON
echo json_encode($status);
?>