<?php
/**
 * REST API Client for Book Management System
 * This script handles communication with the book management API,
 * providing functionality for searching, adding, updating, and deleting books.
 */

 
    // Initialize variables for message display and book list
    $msg = "&nbsp;";  // Default empty message with non-breaking space
    $list = "";       // Will hold the HTML for the book list
    $searchTerm = ""; // Will store the current search term
    
    // Process form submissions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
        // Get the action type from POST data
        $action = $_POST['action'] ?? '';  
        // Define the API endpoint URL
        $apiUrl = "https://russet-v8.wccnet.edu/~sshaper/cps276_examples/chapter12/restapi/api.php/books";  
    
        // Get and encode the search term for URL safety
        $searchTerm = $_POST['search'] ?? '';  
        $encodedSearchTerm = urlencode($searchTerm);  
    
        if ($action === 'search') {  
            // Handle search operation using GET request
            // Initialize cURL session for API call
            $ch = curl_init();
            // Set the URL with search parameter
            curl_setopt($ch, CURLOPT_URL, "$apiUrl?search=$encodedSearchTerm");
            // Ensure cURL returns the response as a string
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // Execute the request and get the response
            $response = curl_exec($ch);
            curl_close($ch);
            // Decode JSON response into PHP array
            $result = json_decode($response, true);
        } else {  
            // Handle add/update/delete operations using POST request
            // Validate required fields based on action
            $id = $_POST['id'] ?? '';
            $title = $_POST['title'] ?? '';
            $author = $_POST['author'] ?? '';
            
            // Validate update operation requirements
            if ($action === 'update') {
                if (empty($id) || !is_numeric($id)) {
                    $msg = 'Error: Book ID is required and must be numeric for update operations.';
                    $result = [];
                } elseif (empty($title) || empty($author)) {
                    $msg = 'Error: Both title and author are required for update operations.';
                    $result = [];
                }
            }
            
            // Validate delete operation requirements
            if ($action === 'delete') {
                if (empty($id) || !is_numeric($id)) {
                    $msg = 'Error: Book ID is required and must be numeric for delete operations.';
                    $result = [];
                }
            }
            
            // Validate add operation requirements
            if ($action === 'add') {
                if (empty($title) || empty($author)) {
                    $msg = 'Error: Both title and author are required for add operations.';
                    $result = [];
                }
            }
            
            // Proceed with API call if validation passed
            if (!isset($result)) {
                // Prepare POST data
                $postData = [  
                    'action' => $action,  
                    'id' => $id,  
                    'title' => $title,  
                    'author' => $author,  
                ];  
        
                // Initialize cURL session for POST request
                $ch = curl_init();
                // Set the API endpoint URL
                curl_setopt($ch, CURLOPT_URL, $apiUrl);
                // Specify this is a POST request
                curl_setopt($ch, CURLOPT_POST, true);
                // Set the POST data
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
                // Ensure cURL returns the response as a string
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                // Set the content type header
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/x-www-form-urlencoded'
                ]);
                
                // Execute the request and get the response
                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
                
                // Check for cURL errors
                if ($response === false) {
                    $msg = 'Error: Failed to connect to the API.';
                    $result = [];
                } else {
                    // Decode JSON response into PHP array
                    $result = json_decode($response, true);
                    
                    // Store the operation result message
                    $msg = $result['message'] ?? 'An error occurred.';  
                    
                    // For update operations, verify the book was actually updated
                    if ($action === 'update' && isset($result['message']) && $result['message'] === 'Book updated successfully') {
                        // Fetch all books to verify the update
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "$apiUrl?search=%");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $verifyResponse = curl_exec($ch);
                        curl_close($ch);
                        $verifyResult = json_decode($verifyResponse, true);
                        
                        // Check if the book exists with the updated values
                        $bookFound = false;
                        if (isset($verifyResult['books']) && is_array($verifyResult['books'])) {
                            foreach ($verifyResult['books'] as $book) {
                                if ($book['id'] == $id && $book['title'] === $title && $book['author'] === $author) {
                                    $bookFound = true;
                                    break;
                                }
                            }
                        }
                        
                        // If book not found with updated values, the update may have failed
                        if (!$bookFound) {
                            $msg = 'Warning: Update reported success, but the book was not found with the updated values. The book ID may not exist or the update did not complete.';
                        }
                    }
                }
            }
    
            // Fetch updated book list after modification (if not already set)
            if (!isset($result) || (isset($result['message']) && $result['message'] !== 'Error querying the database')) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "$apiUrl?search=$encodedSearchTerm");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                $result = json_decode($response, true);
            }
        }  
    
        // Generate HTML for the book list if books were found
        if (isset($result['message']) && $result['message'] === 'Book Data' && isset($result['books'])) {  
            // Start unordered list with Bootstrap styling
            $list = '<ul class="list-group">';  
            // Loop through each book and create list items
            foreach ($result['books'] as $book) {  
                $list .= '<li class="list-group-item">';  
                $list .= 'ID: ' . htmlspecialchars($book['id']) . ' - ';  
                $list .= '<strong>' . htmlspecialchars($book['title']) . '</strong> by ' . htmlspecialchars($book['author']);  
                $list .= '</li>';  
            }  
            $list .= '</ul>';  
        } else {  
            // Set message if no books were found
            $msg = $result['message'] ?? 'No books found.';  
        }  
    }  
?>