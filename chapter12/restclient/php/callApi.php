<?php
// Initialize variables for displaying messages and book list
$msg = "&nbsp;";  // Default message (non-breaking space)
$list = "";       // Will hold HTML for the book list
$searchTerm = ""; // Will store the search term entered by user

// Only process if the form was submitted (POST request)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the action from the form (search, add, update, or delete)
    $action = $_POST['action'] ?? '';
    
    // API endpoint URL for book operations
    $apiUrl = "https://russet-v8.wccnet.edu/~sshaper/cps276_examples/chapter12/restapi/api.php/books";

    // Get and encode the search term if provided
    $searchTerm = $_POST['search'] ?? '';
    $encodedSearchTerm = urlencode($searchTerm);

    // Handle different types of actions
    if ($action === 'search') {
        // For search operations:
        // 1. Make a GET request to the API with the search term
        // 2. Decode the JSON response into a PHP array
        $response = file_get_contents("$apiUrl?search=$encodedSearchTerm");

        
        // 3. Decode the JSON response into a PHP array
        $result = json_decode($response, true);
    } else {
        // For add/update/delete operations:
        // 1. Prepare the data to be sent to the API
        $postData = [
            'action' => $action,           // The operation to perform
            'id' => $_POST['id'] ?? '',    // Book ID (for update/delete)
            'title' => $_POST['title'] ?? '',  // Book title
            'author' => $_POST['author'] ?? '', // Book author
        ];

        // Set up the HTTP request options for POST
        $options = [
            'http' => [
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($postData), // Convert array to URL-encoded string
            ],
        ];

        // 2. Make the POST request to perform the action
        $context = stream_context_create($options);
        $response = file_get_contents($apiUrl, false, $context);
        $result = json_decode($response, true);
        
        // 3. Store the operation result message
        $msg = $result['message'] ?? 'An error occurred.';

        // 4. Get the updated book list after the modification
        $response = file_get_contents("$apiUrl?search=$encodedSearchTerm");
        $result = json_decode($response, true);
    }

    // Common code for displaying the book list
    // Check if the response contains valid book data
    if (isset($result['message']) && $result['message'] === 'Book Data' && isset($result['books'])) {
        // Create an unordered list with Bootstrap styling
        $list = '<ul class="list-group">';
        
        // Loop through each book and create list items
        foreach ($result['books'] as $book) {
            $list .= '<li class="list-group-item">';
            $list .= 'ID: ' . htmlspecialchars($book['id']) . ' - ';  // Display book ID
            $list .= '<strong>' . htmlspecialchars($book['title']) . '</strong> by ';  // Display book title
            $list .= htmlspecialchars($book['author']);  // Display author
            $list .= '</li>';
        }
        $list .= '</ul>';
    } else {
        // If no books found or error occurred, display appropriate message
        $msg = $result['message'] ?? 'No books found.';
    }
}
?>