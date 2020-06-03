<?php

namespace Cdro\TelegramBotCore;

use GuzzleHttp\Client as GuzzleClient;

class Client extends GuzzleClient{

    /**
     * Simple chat response
     *
     * @param integer $chatId The chat where to send the message to
     * @param string $text The message
     */
    public function sendMessage($chatId, $text) {
        $this->request('GET', 'sendMessage', [
            'query' => [
                'chat_id' => $chatId,
                'text' => $text
            ]
        ]);
    }
}
