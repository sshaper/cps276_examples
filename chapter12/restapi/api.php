<?php
// Set the response content type to JSON
header('Content-Type: application/json');

// Include the PDO methods class for database operations
require_once 'classes/Pdo_methods.php';

// Initialize PDO object and response array
$pdo = new PdoMethods();
$response = [];

// Get the HTTP method (GET, POST, etc.) and the requested path
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Handle the '/books' endpoint
// Note: The commented out path is for local development, the current path is for the server
if ($path === '/~sshaper/cps276_examples/chapter12/restapi/api.php/books'){
    // Handle GET requests with search parameter
    if ($method === 'GET' && isset($_GET['search'])) {
        // Prepare search term with wildcards for partial matching
        $searchTerm = '%' . $_GET['search'] . '%';
        $sql = "SELECT * FROM books WHERE title LIKE :search";
        $bindings = [[':search', $searchTerm, 'str']];
        $result = $pdo->selectBinded($sql, $bindings);
        
        // Handle different result scenarios
        if ($result === 'error') {
            $response = ['message' => 'Error querying the database'];
        } elseif (empty($result)) {
            $response = ['message' => 'No books found'];
        } else {
            $response = ['message' => 'Book Data', 'books' => $result];
        }
    } 
    // Handle POST requests with action parameter
    elseif ($method === 'POST' && isset($_POST['action'])) {
        // Get book details from POST data
        $title = $_POST['title'] ?? '';
        $author = $_POST['author'] ?? '';
        
        // Handle different actions: add, update, or delete
        if ($_POST['action'] === 'add') {
            // Validate required fields and add new book
            if (!empty($title) && !empty($author)) {
                $sql = "INSERT INTO books (title, author) VALUES (:title, :author)";
                $bindings = [[':title', $title, 'str'], [':author', $author, 'str']];
                $result = $pdo->otherBinded($sql, $bindings);
                $response = ($result === 'noerror') ? ['message' => 'Book added successfully'] : ['message' => 'Error adding book'];
            } else {
                $response = ['message' => 'Title and author are required'];
            }
        } 
        // Handle book update
        elseif ($_POST['action'] === 'update' && isset($_POST['id'])) {
            $id = $_POST['id'];
            $sql = "UPDATE books SET title = :title, author = :author WHERE id = :id";
            $bindings = [[':title', $title, 'str'], [':author', $author, 'str'], [':id', $id, 'int']];
            $result = $pdo->otherBinded($sql, $bindings);
            $response = ($result === 'noerror') ? ['message' => 'Book updated successfully'] : ['message' => 'Error updating book'];
        } 
        // Handle book deletion
        elseif ($_POST['action'] === 'delete' && isset($_POST['id'])) {
            $id = $_POST['id'];
            $sql = "DELETE FROM books WHERE id = :id";
            $bindings = [[':id', $id, 'int']];
            $result = $pdo->otherBinded($sql, $bindings);
            $response = ($result === 'noerror') ? ['message' => 'Book deleted successfully'] : ['message' => 'Error deleting book'];
        }
    }
}

// Output the response as JSON
echo json_encode($response);
