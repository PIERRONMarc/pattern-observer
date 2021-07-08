<?php

namespace MPierron\Observer;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;
use Psr\EventDispatcher\StoppableEventInterface;

class EventDispatcher implements EventDispatcherInterface
{

    private $listenerProvider;

    public function __construct(ListenerProviderInterface $listenerProvider)
    {
        $this->listenerProvider = $listenerProvider;
    }

    public function dispatch(object $event): void
    {
        foreach ($this->listenerProvider->getListenersForEvent($event) as $listener) {
            $listener->listen($event);

            if (
                in_array(StoppableEventInterface::class, class_implements($event))
                && $event->isPropagationStopped()
            ) {
                break;
            }

        }
    }
}