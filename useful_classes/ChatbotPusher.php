<?php

class ChatbotPusher
{
    private string $token;
    
    public function __construct($token): void
    {
        $this->token = $token;
    }
    
    public function send($chatId, $message): array
    {
        $this->writeLog('ChatbotPusher: sending message...');
        $data = [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => true
        ];
        
        $requestResult = $this->request('sendMessage', $data);
        return $requestResult;
    }
    
    private function request($method, $data): array
    {
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, 'https://api.telegram.org/bot' . $this->token .  '/' . $method);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        
        $requestResult = json_decode(curl_exec($curl), true);
        $this->writeLog('ChatbotPusher: telegram response:');
        $this->writeLog(print_r($requestResult, true));
        
        curl_close($curl);
        
        return $requestResult;
    }
    
    private function writeLog($string): void
    {
        // define needed storage or use special class, e.g.:
        // Logger::getInstance()->logAppend($string);
    }
}
