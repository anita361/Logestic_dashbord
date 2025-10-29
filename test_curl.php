<?php
// URL to request
$url = "https://www.googleapis.com/oauth2/v4/token";

// Initialize cURL
$ch = curl_init($url);

// Return the response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Set the CA certificate path (use forward slashes)
curl_setopt($ch, CURLOPT_CAINFO, "C:/xampp/php/extras/ssl/cacert.pem");

// Optional: Enable verbose output for debugging
curl_setopt($ch, CURLOPT_VERBOSE, true);

// Optional: Set timeout (in seconds)
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

// Execute the request
$response = curl_exec($ch);

// Check for errors
if(curl_errno($ch)){
    echo 'cURL Error (' . curl_errno($ch) . '): ' . curl_error($ch);
} else {
    echo 'Success! Response:' . PHP_EOL;
    echo $response;
}

// Close cURL
curl_close($ch);
