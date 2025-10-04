<?php
require_once('vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

use App\Telegram\TelegramSender;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$botToken = $_ENV['TELEGRAM_BOT_TOKEN'] ?? 'not_set';
$telegramSender = new TelegramSender($botToken, 'dummy');

echo "=== Testing Bot Connection ===" . PHP_EOL;
$botInfo = $telegramSender->testConnection();
if (isset($botInfo['ok']) && $botInfo['ok']) {
    echo "✅ Bot is working: " . $botInfo['result']['first_name'] . " (@" . $botInfo['result']['username'] . ")" . PHP_EOL;
} else {
    echo "❌ Bot connection failed" . PHP_EOL;
    print_r($botInfo);
}

echo PHP_EOL . "=== Recent Updates (to find chat ID) ===" . PHP_EOL;
$updates = $telegramSender->getRecentUpdates();
if (isset($updates['ok']) && $updates['ok']) {
    if (empty($updates['result'])) {
        echo "No recent messages. User needs to send /start to the bot first." . PHP_EOL;
        echo "Bot link: https://t.me/" . $botInfo['result']['username'] . PHP_EOL;
    } else {
        echo "Recent messages:" . PHP_EOL;
        foreach ($updates['result'] as $update) {
            if (isset($update['message'])) {
                $message = $update['message'];
                $from = $message['from'];
                echo "- User: @" . ($from['username'] ?? 'no_username') .
                     " (ID: " . $from['id'] .
                     ", Name: " . $from['first_name'] . ")" . PHP_EOL;
            }
        }
    }
} else {
    echo "❌ Failed to get updates" . PHP_EOL;
    print_r($updates);
}

echo PHP_EOL . "=== Instructions ===" . PHP_EOL;
echo "1. Go to https://t.me/" . ($botInfo['result']['username'] ?? 'your_bot') . PHP_EOL;
echo "2. Send /start to the bot" . PHP_EOL;
echo "3. Run this script again to see your chat ID" . PHP_EOL;
echo "4. Use the numeric chat ID instead of @username" . PHP_EOL;