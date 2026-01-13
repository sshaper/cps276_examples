<?php
$file_path = "./files/example.txt";
$copy_path = "./files/example_copy.txt";
$renamed_path = "./files/example_renamed.txt";
$data_to_write = "Hello, World!";
$additional_data = "\nAppended text.";
$additional_contents = "This is additional content.\n";
$result = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    
    switch ($action) {
        case 'read':
            if ($handle = fopen($file_path, "r")) {
                $file_contents = "";
                while (!feof($handle)) {
                    $file_contents .= fread($handle, 8192);
                }
                fclose($handle);

$code = <<<HTML
Below is the code.  \$file_path is ./files/example.txt<br>
if (\$handle = fopen(\$file_path, "r")) {
    \$file_contents = "";
    while (!feof(\$handle)) {
        \$file_contents .= fread(\$handle, 8192);//8192 is the number of bytes that fread() will read from the file at a time.
    }
    fclose(\$handle);
}
HTML;
                $result = "<strong>File Contents:</strong><br>" . nl2br(htmlspecialchars($file_contents));
                $result .= "<div><pre>{$code}</pre></div>";
            } else {
                $result = "Cannot open the file: $file_path";
            }
            break;
        
        case 'write':
            if ($handle = fopen($file_path, "w")) {
                fwrite($handle, $data_to_write);
                fclose($handle);

$code = <<<HTML
Below is the code.  \$file_path is ./files/example.txt<br>\$data_to_write is Hello, World!<br>
if (\$handle = fopen(\$file_path, "w")) {
    fwrite(\$handle, \$data_to_write);
    fclose(\$handle);
}
HTML;
                $result = "Data written to the file: $data_to_write";
                $result .= "<div><pre>{$code}</pre></div>";
            } else {
                $result = "Cannot open the file for writing: $file_path";
            }
            break;

        case 'append':
            if ($handle = fopen($file_path, "a")) {
                fwrite($handle, $additional_data);
                fclose($handle);

$code = <<<HTML
Below is the code.<br>\$file_path is ./files/example.txt<br>\$additional_data is "\\nAppended text."<br>
if (\$handle = fopen(\$file_path, "a")) {
    fwrite(\$handle, \$additional_data);
    fclose(\$handle);
}
HTML;
                $result = "Data appended to the file: $additional_data";
                $result .= "<div><pre>{$code}</pre></div>";
            } else {
                $result = "Cannot open the file for appending: $file_path";
            }
            break;

        case 'clear':
            if ($handle = fopen($file_path, "w")) {
                fwrite($handle, "");
                fclose($handle);

$code = <<<HTML
Below is the code.  <br>\$file_path is ./files/example.txt<br>
if (\$handle = fopen(\$file_path, "w")) {
    fwrite(\$handle, "");
    fclose(\$handle);
}
HTML;
                $result = "File {$file_path} has been cleared!";
                $result .= "<div><pre>{$code}</pre></div>";
            } else {
                $result = "Cannot open the file for writing: $file_path";
            }
            break;

        case 'copy':
            if (copy($file_path, $copy_path)) {

$code = <<<HTML
Below is the code.  
<br>\$file_path is ./files/example.txt<br>\$copy_path is ./files/example_copy.txt<br>
if (copy(\$file_path, \$copy_path)) {
    ...
}
HTML;
                $result = "File copied to: $copy_path";
                $result .= "<div><pre>{$code}</pre></div>";
            } else {
                $result = "Failed to copy the file: $file_path";
            }
            break;

        case 'rename':
            if (rename($copy_path, $renamed_path)) {

$code = <<<HTML
Below is the code.<br>\$copy_path is ./files/example_copy.txt<br>\$renamed_path is ./files/example_renamed.txt<br>
if (rename(\$copy_path, \$renamed_path)) {
    ...
}
HTML;
                $result = "File renamed to: $renamed_path";
                $result .= "<div><pre>{$code}</pre></div>";
            } else {
                $result = "Failed to rename the file: $copy_path";
            }
            break;

        case 'delete':
            if (unlink($renamed_path)) {

$code = <<<HTML
Below is the code.  \$renamed_path is ./files/example_renamed.txt<br>
if (unlink(\$renamed_path)) {
    ...
}
HTML;
                $result = "File deleted: $renamed_path";
                $result .= "<div><pre>{$code}</pre></div>";
            } else {
                $result = "Failed to delete the file: $renamed_path";
            }
            break;

        case 'get_contents':
            $file_contents = file_get_contents($file_path);
            if ($file_contents !== false) {

$code = <<<HTML
Below is the code.  \$file_path is ./files/example.txt<br>
\$file_contents = file_get_contents(\$file_path);
if (\$file_contents !== false) {
    ...
}
HTML;
                $result = "<strong>File contents read using file_get_contents:</strong><br>" . nl2br(htmlspecialchars($file_contents));
                $result .= "<div><pre>{$code}</pre></div>";
            } else {
                $result = "Failed to read the file using file_get_contents: $file_path";
            }
            break;

        case 'put_contents':
            if (file_put_contents($file_path, $additional_contents, FILE_APPEND | LOCK_EX) !== false) {

$code = <<<HTML
Below is the code.  \$file_path is ./files/example.txt<br>\$additional_contents is "This is additional content.\\n"<br>
if (file_put_contents(\$file_path, \$additional_contents, FILE_APPEND | LOCK_EX) !== false) {
    ...
}
HTML;
                $result = "Additional content written using file_put_contents";
                $result .= "<div><pre>{$code}</pre></div>";
            } else {
                $result = "Failed to write additional content using file_put_contents: $file_path";
            }
            break;

        default:
            $result = "Invalid action.";
            break;
    }
}

return $result;
?>