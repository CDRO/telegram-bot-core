<?php

namespace Cdro\TelegramBotCore\Security;

class SimpleLayer implements LayerInterface {

    /**
     * Make the security check and execute a callback
     * @param callable|null $options
     */
    public function check(callable $options = null)
    {
        if(!is_null($options)) {
            $options();
        }
    }
}
