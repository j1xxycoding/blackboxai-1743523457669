<?php
// Telegram Bot Configuration
define('TELEGRAM_BOT_TOKEN', 'YOUR_BOT_TOKEN'); // Replace with your bot token
define('TELEGRAM_API_URL', 'https://api.telegram.org/bot' . TELEGRAM_BOT_TOKEN . '/');

// Error Logging Configuration
define('ERROR_LOG_PATH', __DIR__ . '/error.log');

// Enable error logging
ini_set('log_errors', 1);
ini_set('error_log', ERROR_LOG_PATH);

// Website URL (update with your domain)
define('WEBSITE_URL', 'https://your-domain.com');
?>