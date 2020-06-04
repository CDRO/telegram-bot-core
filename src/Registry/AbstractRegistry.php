<?php

namespace Cdro\TelegramBotCore\Registry;

use Cdro\TelegramBotCore\Client\Client;

abstract class AbstractRegistry {

    /**
     * Call Client
     * @param Client $client
     */
    protected $client;

    /**
     * loaded

    /**
     * Initialize class, ensure that a client is present
     * @param Client $client
     */
    public function __construct(Client $client) {
        $this->client = $client;
    }
    
    /**
     * Load up the data
     */
    abstract public function load();

    /**
     * Save the data
     */
    abstract public function save();

    /**
     * Process a message
     * @param $message
     */
    abstract public function process($message);

    /**
     * Get the saved data
     */
    abstract public function get();
}
