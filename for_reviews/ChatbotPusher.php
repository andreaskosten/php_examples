<?php

/**
 * Class ChatbotPusher sends a message with provided text to provided telegram user or group chat
 *
 * Example of use:
 * $cb = new ChatbotPusher('1234567890:AbCdEfGhIjKlMnOpQrStUvWxYz');
 * $cb->sendMessage(12345678, 'hello');
 */

class ChatbotPusher
{
    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Prepare data for sending simple text message
     *
     * @param int $chatId
     * @param string $message
     *
     * @return array
     */
    public function sendMessage(int $chatId, string $message): array
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

    /**
     * Send request to telegram API with provided data in order to use provided API method
     *
     * @param string $method
     * @param array $data
     *
     * @return array
     */
    private function request(string $method, array $data): array
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

    /**
     * Save provided text in log
     *
     * @param string $text
     */
    private function writeLog(string $text): void
    {
        // define needed storage or use special class, e.g.:
        // Logger::getInstance()->logAppend($text);
    }
}
