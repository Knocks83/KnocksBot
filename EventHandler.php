<?php

include 'config.php';

if ($enableMySQL) {
    include 'MySQL.php';
    $mysql = new MySQL($mysql_host, $mysql_username, $mysql_password, $mysql_db);
}

class EventHandler extends \danog\MadelineProto\EventHandler
{
    public function __construct($MadelineProto)
    {
        parent::__construct($MadelineProto);
    }

    public function onAny($update)
    {
        \danog\MadelineProto\Logger::log("Received an update of type ".$update['_']);
    }

    public function onLoop()
    {
        \danog\MadelineProto\Logger::log("Working...");
    }

    public function onUpdateNewChannelMessage($update)
    {
        // Watch out, channel is also groups!
        $isPrivateChat = false;
        $user_id = $update['message']['from_id'];
        $chat_id = $update['message']['to_id']['channel_id'];
        $msg_id = $update['message']['id'];
        if (isset($update['message']['message'])) {
            $text = $update['message']['message'];
        }
        if (isset($update['message']['action'])) {
            $action = $update['message']['action'];
        }

        try {
            include 'commands.php';
        } catch (Error $e) {
            print $e->getMessage();
        }
    }

    public function onUpdateNewMessage($update)
    {
        global $read_outgoing_messages;
        global $bot;

        $isPrivateChat = true;
        if($update['message']['out'] && !$read_outgoing_messages) {
            return;
        }
        $user_id = $update['message']['from_id'];
        $chat_id = $user_id;
        $msg_id = $update['message']['id'];
        $text = $update['message']['message'];

        try {
            include 'commands.php';
        } catch (Error $e) {
            print $e->getMessage();
        }
    }
}
