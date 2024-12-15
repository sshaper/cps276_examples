<?php
header('Content-Type: application/json');

require_once 'classes/Pdo_methods.php';

$pdo = new PdoMethods();
$response = [];

// Determine the HTTP method and endpoint
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Handle `/books` endpoint
//if ($path === '/php/api.php/books') {
if ($path === '/~sshaper/cps276_examples/chapter12/restapi/api.php/books'){
    if ($method === 'GET' && isset($_GET['search'])) {
        // Search for books
        $searchTerm = '%' . $_GET['search'] . '%';
        $sql = "SELECT * FROM books WHERE title LIKE :search";
        $bindings = [[':search', $searchTerm, 'str']];
        $result = $pdo->selectBinded($sql, $bindings);
        if ($result === 'error') {
            $response = ['message' => 'Error querying the database'];
        } elseif (empty($result)) {
            $response = ['message' => 'No books found'];
        } else {
            $response = ['message' => 'Book Data', 'books' => $result];
        }
    } elseif ($method === 'POST' && isset($_POST['action'])) {
        $title = $_POST['title'] ?? '';
        $author = $_POST['author'] ?? '';
        if ($_POST['action'] === 'add') {
            if (!empty($title) && !empty($author)) {
                $sql = "INSERT INTO books (title, author) VALUES (:title, :author)";
                $bindings = [[':title', $title, 'str'], [':author', $author, 'str']];
                $result = $pdo->otherBinded($sql, $bindings);
                $response = ($result === 'noerror') ? ['message' => 'Book added successfully'] : ['message' => 'Error adding book'];
            } else {
                $response = ['message' => 'Title and author are required'];
            }
        } elseif ($_POST['action'] === 'update' && isset($_POST['id'])) {
            $id = $_POST['id'];
            $sql = "UPDATE books SET title = :title, author = :author WHERE id = :id";
            $bindings = [[':title', $title, 'str'], [':author', $author, 'str'], [':id', $id, 'int']];
            $result = $pdo->otherBinded($sql, $bindings);
            $response = ($result === 'noerror') ? ['message' => 'Book updated successfully'] : ['message' => 'Error updating book'];
        } elseif ($_POST['action'] === 'delete' && isset($_POST['id'])) {
            $id = $_POST['id'];
            $sql = "DELETE FROM books WHERE id = :id";
            $bindings = [[':id', $id, 'int']];
            $result = $pdo->otherBinded($sql, $bindings);
            $response = ($result === 'noerror') ? ['message' => 'Book deleted successfully'] : ['message' => 'Error deleting book'];
        }
    }
}

// Output the response
echo json_encode($response);
