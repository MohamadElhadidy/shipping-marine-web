<?php

namespace App\Notifications;

class WhatsappNotifications
{
    public function send($message, $receiver)
    {
        $instance ='instance289321';
        $token = 'jq8uqjau54shlok1';
        
        if($receiver == 'it') $chat_id =   "201028879986-1560586609@g.us";
        if($receiver == 'shipping') $chat_id =   "201028879986-1538555660@g.us";
        if($receiver == 'ceo') $chat_id =   "201028879986-1624909257@g.us";

        $data = [
            "chatId" => $chat_id,   
            "body" => $message, 
        ];
        $json = json_encode($data); 
        $url = 'https://api.chat-api.com/' . $instance . '/message?token=' . $token;
        $options = stream_context_create(['http' => [
            'method' => 'POST',
            'header' => 'Content-type: application/json',
            'content' => $json,
        ],
        ]);

        file_get_contents($url, false, $options);
    }
}