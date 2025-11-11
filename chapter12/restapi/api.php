<?php
/**
 * REST API for Book Management System
 * This API provides endpoints for managing books with CRUD operations
 * and search functionality.
 */


// Set response type to JSON to ensure proper API response format
header('Content-Type: application/json');

// Include the database connection class that handles PDO operations
require_once 'classes/Pdo_methods.php';

// Initialize database connection and prepare response array
$pdo = new PdoMethods();
$response = [];

// Extract HTTP method (GET, POST, etc.) and request path from server variables
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Handle requests to the /books endpoint
if ($path === '/~sshaper/cps276_examples/chapter12/restapi/api.php/books') {
    // Handle GET requests - Used for searching books
    if ($method === 'GET' && isset($_GET['search'])) {
        // Prepare search term with wildcards for partial matching
        $searchTerm = '%' . $_GET['search'] . '%';
        $sql = "SELECT * FROM books WHERE title LIKE :search";
        $bindings = [[':search', $searchTerm, 'str']];
        $result = $pdo->selectBinded($sql, $bindings);
        
        // Handle different response scenarios
        if ($result === 'error') {
            $response = ['message' => 'Error querying the database'];
        } elseif (empty($result)) {
            $response = ['message' => 'No books found'];
        } else {
            $response = ['message' => 'Book Data', 'books' => $result];
        }
    }
    // Handle POST requests - Used for adding, updating, and deleting books
    elseif ($method === 'POST' && isset($_POST['action'])) {
        // Extract book details from POST data
        $title = $_POST['title'] ?? '';
        $author = $_POST['author'] ?? '';
        
        // Handle adding a new book
        if ($_POST['action'] === 'add') {
            // Validate required fields
            if (!empty($title) && !empty($author)) {
                $sql = "INSERT INTO books (title, author) VALUES (:title, :author)";
                $bindings = [
                    [':title', $title, 'str'],
                    [':author', $author, 'str']
                ];
                $result = $pdo->otherBinded($sql, $bindings);
                $response = ($result === 'noerror') 
                    ? ['message' => 'Book added successfully']
                    : ['message' => 'Error adding book'];
            } else {
                $response = ['message' => 'Title and author are required'];
            }
        }
        // Handle updating an existing book
        elseif ($_POST['action'] === 'update' && isset($_POST['id'])) {
            $id = $_POST['id'];
            $sql = "UPDATE books SET title = :title, author = :author WHERE id = :id";
            $bindings = [
                [':title', $title, 'str'],
                [':author', $author, 'str'],
                [':id', $id, 'int']
            ];
            $result = $pdo->otherBinded($sql, $bindings);
            $response = ($result === 'noerror')
                ? ['message' => 'Book updated successfully']
                : ['message' => 'Error updating book'];
        }
        // Handle deleting a book
        elseif ($_POST['action'] === 'delete' && isset($_POST['id'])) {
            $id = $_POST['id'];
            $sql = "DELETE FROM books WHERE id = :id";
            $bindings = [[':id', $id, 'int']];
            $result = $pdo->otherBinded($sql, $bindings);
            $response = ($result === 'noerror')
                ? ['message' => 'Book deleted successfully']
                : ['message' => 'Error deleting book'];
        }
    }
}

// Send the JSON response back to the client
echo json_encode($response);
?>