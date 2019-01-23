<?php

include 'config.php';

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
        global $read_outgoing_messages;
        global $bot;
        $isPrivateChat = false;

        $chat_id = $update['message']['to_id']['channel_id'];
        if (isset($update['message']['from_id'])) {
            $user_id = $update['message']['from_id'];
        } else {
            $user_id = $chat_id;
        }
        
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
        
        if (isset($update['message']['message'])) {
            $text = $update['message']['message'];
        }

        try {
            include 'commands.php';
        } catch (Error $e) {
            print $e->getMessage();
        }
    }
}
