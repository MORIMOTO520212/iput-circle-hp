<?php

// デプロイID
$id = 'AKfycbyT1dyHETFo9r4Z1SRsh23sa6hTTx-Vfs6bKmt0-xvCDURrubEVdAFSWhY4vSHvj4nN';
//POST送信先
$post_url = "https://script.google.com/macros/s/$id/exec";
//POSTデータ
$post_data = array(
    "toAddress" => "mikihito19990619@gmail.com",
    "name" => "へのへのもへじ",
    "id" => "TK200000",
    "major" => "デジタルエンタテインメント",
    "grade" => "4",
);

//cURL
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $post_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_POST => true, 
    CURLOPT_POSTFIELDS => json_encode($post_data),
]);
$result = curl_exec($ch);
curl_close($ch);

$response_data = json_decode($result, true); 

// print_r($post_data);
print_r($response_data['message']);

?>