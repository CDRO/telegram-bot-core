<?php

namespace Cdro\TelegramBotCore\Security;

interface LayerInterface {

    /**
     * Make the security check and execute a callback
     */
    public function check();
}
