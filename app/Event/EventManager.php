<?php

namespace App\Event;

use N1215\Tsukuyomi\Event\EventManagerInterface;

class EventManager implements EventManagerInterface
{
    /**
     * @inheritDoc
     */
    public function attach($event, $callback, $priority = 0)
    {
        // TODO: Implement attach() method.
    }

    /**
     * @inheritDoc
     */
    public function clearListeners($event)
    {
        // TODO: Implement clearListeners() method.
    }

    /**
     * @inheritDoc
     */
    public function detach($event, $callback)
    {
        // TODO: Implement detach() method.
    }

    /**
     * @inheritDoc
     */
    public function trigger($event, $target = null, $argv = array())
    {
        // TODO: Implement trigger() method.
    }
}