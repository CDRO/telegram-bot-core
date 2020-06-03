<?php

namespace Cdro\TelegramBotCore\Client;

class Factory {

    /**
     * Do not allow instanciations of this class
     */
    private function __construct() {}

    /**
     * Get a new client
     *
     * @param string $botToken Your bot token
     */
    public static function getInstance(string $botToken, float $timeout = 2.0) {
        return new Client([
            'base_uri' => 'https://api.telegram.org/bot' . $botToken . '/',
            'timeout' => $timeout
        ]);
    }
}
