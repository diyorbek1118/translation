<?php

// Define the source and target languages and the word to be translated
$lan1 = 'uz';
$lan2 = 'en';
$word = 'salom';

// Correct the URL with the proper variable name and encode the word
$url = "https://api.mymemory.translated.net/get?q=" . urlencode($word) . "&langpair={$lan1}|{$lan2}";

// Use cURL to make the API request
$ch = curl_init();

// Set the cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Execute the request and store the response
$response = curl_exec($ch);

// Close the cURL session
curl_close($ch);

// Decode the JSON response
$responseData = json_decode($response, true);

// Print the translated text
if (isset($responseData['responseData']['translatedText'])) {
    echo 'Translation: ' . $responseData['responseData']['translatedText'];
} else {
    echo 'Error: Unable to retrieve translation';
}
?>
