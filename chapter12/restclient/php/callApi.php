<?php
$msg = "&nbsp;";
$list = "";
$searchTerm = "";

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $apiUrl = "https://russet-v8.wccnet.edu/~sshaper/cps276_examples/chapter12/restapi/api.php/books";

    // Store the search term if provided
    $searchTerm = $_POST['search'] ?? '';
    $encodedSearchTerm = urlencode($searchTerm);

    // Prepare POST data
    $postData = [
        'action' => $action,
        'id' => $_POST['id'] ?? '',
        'title' => $_POST['title'] ?? '',
        'author' => $_POST['author'] ?? '',
    ];

    // Make the API call using file_get_contents
    $options = [
        'http' => [
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($postData),
        ],
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($apiUrl, false, $context);

    // Decode API response
    $result = json_decode($response, true);

    // Handle Add, Update, Delete, and Search actions
    if ($action === 'search') {
        $response = file_get_contents("$apiUrl?search=$encodedSearchTerm");
        $result = json_decode($response, true);
        if (isset($result['message']) && $result['message'] === 'Book Data' && isset($result['books'])) {
            $list = '<ul class="list-group">';
            foreach ($result['books'] as $book) {
                $list .= '<li class="list-group-item">';
                $list .= 'ID: ' . htmlspecialchars($book['id']) . ' - ';
                $list .= '<strong>' . htmlspecialchars($book['title']) . '</strong> by ' . htmlspecialchars($book['author']);
                $list .= '</li>';
            }
            $list .= '</ul>';
        } else {
            $msg = $result['message'] ?? 'No books found.';
        }
    } else {
        // Display message for Add, Update, or Delete
        $msg = $result['message'] ?? 'An error occurred.';

        // After Add/Update/Delete, fetch the updated book list with the current search term
        $response = file_get_contents("$apiUrl?search=$encodedSearchTerm");
        $result = json_decode($response, true);

        if (isset($result['message']) && $result['message'] === 'Book Data' && isset($result['books'])) {
            $list = '<ul class="list-group">';
            foreach ($result['books'] as $book) {
                $list .= '<li class="list-group-item">';
                $list .= 'ID: ' . htmlspecialchars($book['id']) . ' - ';
                $list .= '<strong>' . htmlspecialchars($book['title']) . '</strong> by ' . htmlspecialchars($book['author']);
                $list .= '</li>';
            }
            $list .= '</ul>';
        }
    }
}
?>