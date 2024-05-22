<?php

$result = "";
$photo_url = ""; // $photo_url ni bo'sh qilib e'lon qilish

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $lan1 = $_POST['lan1'];
    $lan2 = $_POST['lan2'];
    $word = $_POST['word'];
    $client_id = 'Xu7CNF6j09VP4qb6eCCwqrzmAoEK3j4HZNQpieDKntc'; // Sizning Unsplash API kalitingiz
    $page = 1; // Sahifa raqami

   

    // MyMemory API chaqiruv
    $mymemory_url = "https://api.mymemory.translated.net/get?q=" . urlencode($word) . "&langpair={$lan1}|{$lan2}";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $mymemory_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // So'rovni bajarish va javobni saqlash
    $mymemory_response = curl_exec($ch);

    // cURL sessiyasini yopish
    curl_close($ch);

    // JSON javobni dekodlash
    $responseData = json_decode($mymemory_response, true);

    // Tarjima qilingan matnni chop etish
    if (isset($responseData['responseData']['translatedText'])) {
        $result = $responseData['responseData']['translatedText'];
    }


    if($lan1=='en'){
        $quey=$word;
    }
    else{
        $query=$result;
    }
     // Unsplash API chaqiruv
     $unsplash_url = "https://api.unsplash.com/search/photos?page={$page}&query={$query}&client_id={$client_id}";

     $unsplash_response = file_get_contents($unsplash_url);
     $unsplash_data = json_decode($unsplash_response, true);
 
     if (isset($unsplash_data['results'][0]['urls']['regular'])) {
         $photo_url = $unsplash_data['results'][0]['urls']['regular'];
     }
    // Javobni JSON formatida qaytarish
    echo json_encode([
        'translation' => $result,
        'photo_url' => $photo_url,
        'input-text' => $word
    ]);
}
?>
