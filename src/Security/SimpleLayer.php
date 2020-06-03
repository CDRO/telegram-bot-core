<?php

namespace Cdro\TelegramBotCore\Security;

class SimpleLayer implements LayerInterface {

    /**
     * Make the security check and execute a callback
     * @param mixed $callback
     */
    public function check(callable $options) {
        $options();
    }
}
