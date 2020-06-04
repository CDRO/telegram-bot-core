<?php

namespace Cdro\TelegramBotCore\Client;

use GuzzleHttp\Client as GuzzleClient;

class Client extends GuzzleClient{

    /**
     * Simple chat response
     *
     * @param integer $chatId The chat where to send the message to
     * @param string $text The message
     */
    public function sendMessage($chatId, $text) {
        list($chatId, $messageId) = explode(':', $chatId);
        $this->request('GET', 'sendMessage', [
            'query' => [
                'chat_id' => $chatId,
                'text' => $text,
                'reply_to_message_id' => $messageId,
            ]
        ]);
    }
}
