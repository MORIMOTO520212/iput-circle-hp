<?php
// none:
// to address
$to = "to email address";
// subject
$subject  = "test subject";
// message
$message = "test message";


// デプロイID
$id = 'AKfycbyT1dyHETFo9r4Z1SRsh23sa6hTTx-Vfs6bKmt0-xvCDURrubEVdAFSWhY4vSHvj4nN';
//POST送信先
$post_url = "https://script.google.com/macros/s/$id/exec";
//POSTデータ
$post_data = array(
    "toAddress" => $to,
    "subject" => $subject,
    "message" => $message,
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


// debug
$response_data = json_decode($result, true); 
echo "送信 => ". $response_data["message"];
// echo ""
// print_r($response_data["message"]);

?>