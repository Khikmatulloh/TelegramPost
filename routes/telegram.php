<?php

declare(strict_types=1);
require 'vendor/autoload.php';
$updates = json_decode(file_get_contents('php://input'));
use App\Bot;
$bot = new Bot($_ENV['TOKEN']);

$users = $bot->getAllUsers();

if(isset($updates->message)){
    $message = $updates->message;
    $chatId = $message->chat->id;
    $text = $message->text;

    if($text === "/start"){
        $bot->handlerStartCommand($chatId);
        return;
    }
}