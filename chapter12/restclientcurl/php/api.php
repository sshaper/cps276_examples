<?php
function getOMDBData($title) {
    $OMDB_API_KEY = 'dd7bc618'; // Your OMDb API key
    $url = 'https://www.omdbapi.com/';

    // Parameters for the cURL request
    $params = [
        't' => $title,
        'apikey' => $OMDB_API_KEY
    ];

    // Initialize a cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");
    curl_setopt($ch, CURLOPT_VERBOSE, true); // Enable verbose output for debugging

    // Execute the request and get the response
    $response = curl_exec($ch);

    // Check for cURL errors
    if ($response === false) {
        // Display detailed error information
        $errorNumber = curl_errno($ch);
        $errorMessage = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        echo "cURL Error ($errorNumber): $errorMessage\n";
        echo "HTTP Response Code: $httpCode\n";
        curl_close($ch);
        return false;
    }

    // Close the cURL session
    curl_close($ch);

    // Decode the JSON response
    $omdb_data = json_decode($response, true);

    // Check if the response indicates success
    if (isset($omdb_data['Response']) && $omdb_data['Response'] !== 'False') {
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
            return false;
        }
    }

?>
