<?php
$botToken = "8740748797:AAEBPa9drKM0cYqoQGqYhtZn3igRi2yOjnY";
$chatId   = "7236038645";

$update = json_decode(file_get_contents('php://input'), true);
$message = $update['message']['text'] ?? '';
$from_id = $update['message']['chat']['id'] ?? '';

if ($message == '/link' && $from_id == $chatId) {
    // Render-এর নিজের ডোমেইন
    $renderDomain = "https://tomake-cai.onrender.com";
    $reply = "🔗 আপনার লিংক:\n" . $renderDomain . "/index.php";

    @file_get_contents("https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=" . urlencode($reply));
}
?>
