<?php

namespace Cdro\TelegramBotCore\Helper;

use \Cdro\TelegramBotCore\Registry\AbstractRegistry;

class WebhookRegistry
{
    /**
     * The registry to save to
     *
     * @var AbstractRegistry
     */
    private $registry;

    public function __construct(AbstractRegistry $registry)
    {
        $this->registry = $registry;
    }


    public function handle()
    {
        $input = file_get_contents('php://input');

        $this->registry->process($input->message);

        $this->registry->save();
    }
}
