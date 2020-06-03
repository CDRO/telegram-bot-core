<?php

namespace Cdro\TelegramBotCore\Security;

interface LayerInterface {

    /**
     * Make the security check and execute a callback
     * @param mixed $callback
     */
    public function check($options = null);
}
