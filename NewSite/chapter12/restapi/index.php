<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'classes/Book.php';

//$database = new Database();
//$db = $database->getConnection();

$book = new Book();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);


$request_method = $_SERVER["REQUEST_METHOD"];



function utf8ize($mixed) {
    if (is_array($mixed)) {
        foreach ($mixed as $key => $value) {
            $mixed[$key] = utf8ize($value);
        }
    } else if (is_string($mixed)) {
        return mb_convert_encoding($mixed, "UTF-8", "UTF-8");
    }
    return $mixed;
}




if ($uri[7] !== 'books') {
    header("HTTP/1.0 404 Not Found");
    exit();
}




switch ($request_method) {
    
    case 'GET':
        $records = $book->read();
        

        if (count($records) > 0) {
            $books_arr = array();
            foreach($records as $row){
                
                $book_item = array(
                    "id" => $row['id'],
                    "title" => $row['title'],
                    "author" => $row['author'],
                    "isbn" => $row['isbn'],
                    "genre" => $row['genre']
                );

                
                
                array_push($books_arr, $book_item);
            }
            //print_r($books_arr);
            echo json_encode($books_arr);

            // Convert the data to UTF-8
            $books = utf8ize($books_arr);

            // Encode the array to JSON
            $json = json_encode($books);

            // Encode the array to JSON
            //$json = json_encode($books_arr);

            if (json_last_error() !== JSON_ERROR_NONE) {
                echo 'JSON encoding error: ' . json_last_error_msg();
            } else {
                echo $json;
            }



        } else {
            echo json_encode(array("message" => "No books found."));
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        $book->title = $data->title;
        $book->author = $data->author;
        $book->isbn = $data->isbn;

        if ($book->create()) {
            echo json_encode(array("message" => "Book was created."));
        } else {
            echo json_encode(array("message" => "Unable to create book."));
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"));
        $book->id = $data->id;
        $book->title = $data->title;
        $book->author = $data->author;
        $book->isbn = $data->isbn;

        if ($book->update()) {
            echo json_encode(array("message" => "Book was updated."));
        } else {
            echo json_encode(array("message" => "Unable to update book."));
        }
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"));
        $book->id = $data->id;

        if ($book->delete()) {
            echo json_encode(array("message" => "Book was deleted."));
        } else {
            echo json_encode(array("message" => "Unable to delete book."));
        }
        break;

    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
?>
