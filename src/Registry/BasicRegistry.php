<?php

namespace Cdro\TelegramBotCore\Registry;

use Cdro\TelegramBotCore\Client\Client;
use Cdro\TelegramBotCore\Responder\AbstractResponder;
use Cdro\TelegramBotCore\Responder\ResponderInterface;

class BasicRegistry extends AbstractRegistry
{


    /**
     * Path where to store the data
     * @var string
     */
    private $saveFile = '';

    /**
     * @var AbstractResponder
     */
    private $responder;

    /**
     * Initialize the class and make sure that Client and save path are properly set
     * @param AbstractResponder $responder
     * @param string $saveFile
     */
    public function __construct(AbstractResponder $responder, string $saveFile = '')
    {
        $this->responder = $responder;
        $this->saveFile = $saveFile;
    }

    /**
     * @return $this|BasicRegistry
     */
    public function load()
    {
        $tmpData = file_get_contents($this->saveFile);
        if(empty(($this->data = json_decode($tmpData)))) {
            $this->data = new \stdClass();
        }
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
                            $this->responder->alreadyRegistered($message);
                            exit;
                        } elseif($text === '/stop') {
                            unset($this->data->{$chatId});
                            $this->responder->removed($message);
                        }
                    } elseif($text === '/start') {
                        $this->data->{$chatId} = $from;
                        $this->responder->newlyRegistered($message);
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
