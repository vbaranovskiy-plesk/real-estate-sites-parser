<?php
namespace App\Telegram;

use Exception;

class TelegramSender
{
    public function __construct(
        private readonly string $botToken,
        private readonly string $chatId
    ) {
    }

    public function sendDocument(string $filePath, string $caption = ''): bool
    {
        if (!file_exists($filePath)) {
            throw new Exception("File not found: $filePath");
        }

        $url = "https://api.telegram.org/bot{$this->botToken}/sendDocument";

        $postFields = [
            'chat_id' => $this->chatId,
            'document' => new \CURLFile($filePath),
            'caption' => $caption
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_error($ch)) {
            curl_close($ch);
            throw new Exception('Curl error: ' . curl_error($ch));
        }

        curl_close($ch);

        if ($httpCode !== 200) {
            $responseData = json_decode($response, true);
            if ($responseData && isset($responseData['description'])) {
                if (strpos($responseData['description'], 'chat not found') !== false) {
                    throw new Exception("Chat not found. User @{$this->chatId} needs to start the bot first by sending /start");
                }
                throw new Exception("Telegram API error: " . $responseData['description']);
            }
            throw new Exception("Telegram API error. HTTP code: $httpCode. Response: $response");
        }

        $responseData = json_decode($response, true);

        if (!$responseData['ok']) {
            throw new Exception("Telegram API error: " . $responseData['description']);
        }

        return true;
    }

    public function testConnection(): array
    {
        $url = "https://api.telegram.org/bot{$this->botToken}/getMe";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true) ?: [];
    }

    public function getRecentUpdates(): array
    {
        $url = "https://api.telegram.org/bot{$this->botToken}/getUpdates";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);
        return $data ?: [];
    }
}