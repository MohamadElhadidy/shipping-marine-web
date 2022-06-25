<?php

namespace App\Notifications;

class TelegramNotifications 
{
      public function send($message, $receiver)
    {
        $apiToken = "5437763202:AAExxLrPPsjQkZcYoVKSSLRwXJKW2pu0a-c";
        
        if($receiver == 'shipping') $chat_id =   "-1001372815001";
        if($receiver == 'ceo') $chat_id =   "-1001784957951";

       

       $data = [
	            "chat_id" => $chat_id,
                'text' => $message, 
                'parse_mode' => 'markdown'
       ];


       file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );
    }
}
