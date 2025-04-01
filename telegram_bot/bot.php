<?php
require_once __DIR__ . '/TelegramBot.php';

// Initialize the bot
$bot = new TelegramBot();

try {
    // Get the incoming webhook data
    $update = json_decode(file_get_contents('php://input'), true);
    
    // Log the incoming update for debugging
    error_log('Received update: ' . print_r($update, true));
    
    // If no valid update received, exit
    if (!$update) {
        error_log('Invalid update received');
        http_response_code(400);
        exit('Bad Request');
    }
    
    // Handle different types of updates
    if (isset($update['message'])) {
        $message = $update['message'];
        $chatId = $message['chat']['id'];
        $text = $message['text'] ?? '';
        
        // Handle commands
        if (strpos($text, '/') === 0) {
            $command = strtolower(explode(' ', $text)[0]);
            
            switch ($command) {
                case '/start':
                    $welcomeMessage = "👋 Welcome to our Bot!\n\n"
                        . "Here's what you can do:\n"
                        . "• Use /help to see available commands\n"
                        . "• Use /webapp to open our web application\n"
                        . "• Send any message to get a response";
                    
                    $bot->sendMessage($chatId, $welcomeMessage);
                    break;
                    
                case '/help':
                    $helpMessage = "📚 Available Commands:\n\n"
                        . "/start - Start the bot\n"
                        . "/help - Show this help message\n"
                        . "/webapp - Open our web application";
                    
                    $bot->sendMessage($chatId, $helpMessage);
                    break;
                    
                case '/webapp':
                    // Send a message with a button to open the web app
                    $webAppUrl = WEBSITE_URL;
                    $message = "🌐 Click the button below to open our web application!";
                    $bot->sendWebAppMessage($chatId, $message, $webAppUrl);
                    break;
                    
                default:
                    $bot->sendMessage($chatId, "⚠️ Unknown command. Use /help to see available commands.");
                    break;
            }
        } else {
            // Handle regular messages
            $response = "I received your message: " . htmlspecialchars($text);
            $bot->sendMessage($chatId, $response);
        }
    } elseif (isset($update['callback_query'])) {
        // Handle callback queries from inline keyboards
        $callbackQuery = $update['callback_query'];
        $callbackQueryId = $callbackQuery['id'];
        $chatId = $callbackQuery['message']['chat']['id'];
        
        // Answer the callback query
        $bot->answerCallbackQuery($callbackQueryId);
        
        // Process the callback data if needed
        $data = $callbackQuery['data'] ?? '';
        if ($data) {
            $bot->sendMessage($chatId, "Received callback: $data");
        }
    }
    
} catch (Exception $e) {
    error_log('Error in bot.php: ' . $e->getMessage());
    http_response_code(500);
    exit('Internal Server Error');
}

// Return success response
http_response_code(200);
echo 'OK';
?>