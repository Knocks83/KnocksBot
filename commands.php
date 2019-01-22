<?php

include 'config.php';
global $MadelineProto;

if (isset($user_id) && in_array($user_id, $admins)) {
    $isAdmin = true;
} else {
    $isAdmin = false;
}

if (isset($text) && isset($chat_id)) {
    if($isAdmin) {
        // Commands reserved to the admins

        if ($text == '/ping') {
            sendMessage($chat_id, 'Pong!');
        }
        
    }

    // Commands for everyone

    if ($text == '/start') {
        if (!$bot) {
            $MadelineProto->messages->sendMessage(['peer' => $chat_id,'parse_mode' => 'Markdown', 'message' => 'Hi! I\'m a userbot made with [KnocksBot!](https://github.com/Knocks83/KnocksBot.git)']);
        } else {
            sendMessage($chat_id, 'Hi! I\'m a bot made with [KnocksBot!](https://github.com/Knocks83/KnocksBot.git)');
        }
    }
}
