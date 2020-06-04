<?php

namespace Cdro\TelegramBotCore\Responder;

use Cdro\TelegramBotCore\Client\Client;

abstract class AbstractResponder implements ResponderInterface
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    protected function getMessageId($message)
    {
        return $message->chat->id . ':' . $message->message_id;
    }

    public function alreadyRegistered(\stdClass $message)
    {
        $this->client->sendMessage(
            $this->getMessageId($message),
            'You are already registered.'
        );
    }

    public function removed(\stdClass $message)
    {
        $this->client->sendMessage(
            $this->getMessageId($message),
            'You are now removed.'
        );
    }

    public function newlyRegistered(\stdClass $message)
    {
        $this->client->sendMessage(
            $this->getMessageId($message),
            'You are now registered.'
        );
    }
}