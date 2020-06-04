<?php

namespace Cdro\TelegramBotCore\Registry;

use Cdro\TelegramBotCore\Client\Client;

class BasicRegistry extends AbstractRegistry
{
    /**
     * Path where to store the data
     * @var string
     */
    private $saveFile = '';

    /**
     * Initialize the class and make sure that Client and save path are properly set
     * @param Client $client
     * @param string $savePath
     */
    public function __construct(Client $client, string $saveFile = '')
    {
        $this->client = $client;
        $this->saveFile = $saveFile;
    }

    /**
     * @return $this|BasicRegistry
     */
    public function load()
    {
        $this->data = json_decode(file_get_contents($this->saveFile));
        $this->isLoaded = true;
        return $this;
    }

    /**
     * Process a message
     * @param mixed $message
     * @param $this|BasicRegistry
     */
    public function process($message)
    {
        if(array_key_exists('entities', $message) && is_array($message->entities)) {
            $from = $message->from;
            $chatId = $message->chat->id;
            $text = $message->text;
            foreach($message->entities as $entity) {
                if($entity->type === 'bot_command') {
                    if(!empty($this->data->{$chatId})) {
                        // Prevent double registration and inform the user that they are already registered
                        if($text === '/start') {
                            $this->client->sendMessage($chatId, 'You are already registered.');
                            exit;
                        } elseif($text === '/stop') {
                            unset($this->data->{$chatId});
                            $this->client->sendMessage(
                                $chatId, 
                                sprintf(
                                    'Hello %s %s, you have been succesfully removed form our user base.', 
                                    $from->first_name, 
                                    $from->last_name
                                    )
                                );
                        }
                    } elseif($text === '/start') {
                        $this->data->{$chatId} = $from;
                        $this->client->sendMessage(
                            $chatId, 
                            sprintf(
                                'Hello %s %s, you are now able to receive 2FA token through Telegram.', 
                                $from->first_name, 
                                $from->last_name
                                )
                        );
                    } else {
                        exit;
                    }
                }
            }
        }
    }

    /**
     * @return $this|BasicRegistry
     */
    public function save()
    {
        file_put_contents($this->saveFile, json_encode($this->data));
        return $this;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return clone $this->data;
    }
}
