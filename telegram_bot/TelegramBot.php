<?php
class TelegramBot {
    private $token;
    private $apiUrl;

    public function __construct() {
        require_once __DIR__ . '/config.php';
        $this->token = TELEGRAM_BOT_TOKEN;
        $this->apiUrl = TELEGRAM_API_URL;
    }

    /**
     * Execute a request to Telegram API
     * @param string $method The API method to call
     * @param array $data The parameters to send
     * @return array|false Returns decoded response or false on failure
     */
    public function execRequest($method, $data = []) {
        try {
            $url = $this->apiUrl . $method;
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            
            if (!empty($data)) {
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            }
            
            $response = curl_exec($ch);
            
            if (curl_errno($ch)) {
                error_log('Curl error in TelegramBot::execRequest: ' . curl_error($ch));
                return false;
            }
            
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            
            if ($httpCode !== 200) {
                error_log("HTTP Error in TelegramBot::execRequest: Code $httpCode, Response: $response");
                return false;
            }
            
            $decodedResponse = json_decode($response, true);
            
            if (!$decodedResponse) {
                error_log('JSON decode error in TelegramBot::execRequest: ' . json_last_error_msg());
                return false;
            }
            
            return $decodedResponse;
            
        } catch (Exception $e) {
            error_log('Exception in TelegramBot::execRequest: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send a message to a chat
     * @param int $chatId The chat ID to send the message to
     * @param string $text The message text
     * @param array $options Additional options (reply_markup, parse_mode, etc.)
     * @return array|false Returns API response or false on failure
     */
    public function sendMessage($chatId, $text, $options = []) {
        $data = [
            'chat_id' => $chatId,
            'text' => $text
        ];
        
        if (!empty($options)) {
            $data = array_merge($data, $options);
        }
        
        return $this->execRequest('sendMessage', $data);
    }

    /**
     * Answer a callback query
     * @param string $callbackQueryId The callback query ID
     * @param string $text Optional text to show to the user
     * @return array|false Returns API response or false on failure
     */
    public function answerCallbackQuery($callbackQueryId, $text = '') {
        $data = [
            'callback_query_id' => $callbackQueryId
        ];
        
        if ($text) {
            $data['text'] = $text;
        }
        
        return $this->execRequest('answerCallbackQuery', $data);
    }

    /**
     * Send a web app message with custom keyboard
     * @param int $chatId The chat ID
     * @param string $text The message text
     * @param string $webAppUrl The URL of the web application
     * @return array|false Returns API response or false on failure
     */
    public function sendWebAppMessage($chatId, $text, $webAppUrl) {
        $keyboard = [
            'inline_keyboard' => [
                [
                    [
                        'text' => 'Open Web App',
                        'web_app' => ['url' => $webAppUrl]
                    ]
                ]
            ]
        ];
        
        return $this->sendMessage($chatId, $text, [
            'reply_markup' => json_encode($keyboard),
            'parse_mode' => 'HTML'
        ]);
    }
}
?>