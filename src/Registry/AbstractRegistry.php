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

    final public function run() {
        if(!$this->isLoaded) {
            throw new \RuntimeException('Ensure you load up your data before running the registry!');
        }
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
