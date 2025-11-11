<?php
/**
 * Function to fetch movie data from OMDb API
 * @param string $title The movie title to search for
 * @return string|bool Returns formatted HTML string with movie data or false on error
 */
function getOMDBData($title) {
    // OMDb API key and base URL
    $OMDB_API_KEY = 'xxxxxxxx'; // OMDb API key
    $url = 'https://www.omdbapi.com/';

    // Prepare query parameters for the API request
    $params = [
        't' => $title,        // Title parameter
        'apikey' => $OMDB_API_KEY  // API key for authentication
    ];

    // Initialize a new cURL session
    $ch = curl_init();

    // Configure cURL options
    curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($params));  // Set the complete URL with parameters
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Return the response instead of outputting it
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);  // Follow any redirects
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");  // Set a user agent
    curl_setopt($ch, CURLOPT_VERBOSE, true);  // Enable verbose output for debugging

    // Execute the cURL request and store the response
    $response = curl_exec($ch);

    // Handle cURL errors
    if ($response === false) {
        // Get detailed error information
        $errorNumber = curl_errno($ch);
        $errorMessage = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Output error details
        echo "cURL Error ($errorNumber): $errorMessage\n";
        echo "HTTP Response Code: $httpCode\n";
        curl_close($ch);
        return false;
    }

    // Close the cURL session
    curl_close($ch);

    echo "<pre>";
    print_r($response);
    echo "</pre>";

    // Decode the JSON response into a PHP array
    $omdb_data = json_decode($response, true);

    

    // Check if the API response indicates success
    if (isset($omdb_data['Response']) && $omdb_data['Response'] !== 'False') {
        // Build HTML output with movie details
        $output =  "<p>&nbsp;</p><p>Title: " . $omdb_data['Title'] . "</p>";
        $output .= "<p>Year: " . $omdb_data['Year'] . "</p>";
        $output .= "<p>Rated: " . $omdb_data['Rated'] . "</p>";
        $output .= "<p>Release Date: " . $omdb_data['Released'] . "</p>";
        $output .= "<p>Runtime: " . $omdb_data['Runtime'] . "</p>";
        $output .= "<p>Genre: " . $omdb_data['Genre'] . "</p>";
        $output .= "<p>Director: " . $omdb_data['Director'] . "</p>";
        $output .= "<p>Actors: " . $omdb_data['Actors'] . "</p>";
        $output .= "<p>Plot: " . $omdb_data['Plot'] . "</p>";
        $output .= "<p><img src='".$omdb_data['Poster']."'></p>";

        return $output;
    } 
    else {
        // Return false if the movie was not found or there was an error
        return false;
    }
}

?>
