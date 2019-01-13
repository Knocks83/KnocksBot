<?php

function closeConnection($message = 'OK!') {
        if (php_sapi_name() === 'cli' || isset($GLOBALS['exited'])) {
            return;
        }
        @ob_end_clean();
        header('Connection: close');
        ignore_user_abort(true);
        ob_start();
        echo '<html><body><h1>'.$message.'</h1></body</html>';
        $size = ob_get_length();
        header("Content-Length: $size");
        header('Content-Type: text/html');
        ob_end_flush();
        flush();
        $GLOBALS['exited'] = true;
}

function lockFile(String $name = 'bot.lock')
{
        if (!file_exists($name)) {
            touch($name);
        }
        $lock = fopen($name, 'r+');
        
        $try = 1;
        $locked = false;
        while (!$locked) {
            $locked = flock($lock, LOCK_EX | LOCK_NB);
            if (!$locked) {
                closeConnection();
        
                if ($try++ >= 30) {
                    exit;
                }
                sleep(1);
            }
        }

        closeConnection();

        return $lock;
}

function joinChat($chatLink, $chatLOG)
{
        global $MadelineProto;

        try {
            if (stripos($chatLink, 'joinchat')) {
                $MadelineProto->messages->importChatInvite([
                    'hash' => str_replace('https://t.me/joinchat/', '', $chatLink),
                ]);
            } else {
                $MadelineProto->channels->joinChannel([
                    'channel' => '@'.str_replace('@', '', $chatLink),
                ]);
            }
            sm($chatLOG, 'Sono entrato nel canale/gruppo');
        } catch (\danog\MadelineProto\RPCErrorException $e) {
            sm($chatLOG, 'NON sono entrato nel canale/gruppo.');
        } catch (\danog\MadelineProto\Exception $e2) {
            sm($chatLOG, 'NON sono entrato nel canale/gruppo.');
        }
}

function getInfo($userID)
{
        global $MadelineProto;
        return $MadelineProto->get_full_info($id);
}
