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
    abstract function load(): self;

    /**
     * Save the data
     */
    abstract function save(): self;

    /**
     * Process a message
     */
    abstract function process($message): self;
}
