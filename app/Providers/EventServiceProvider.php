<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Container\Container;
use N1215\Tsukuyomi\Event\AppTerminating;
use N1215\Tsukuyomi\Event\EventManager;
use N1215\Tsukuyomi\Event\EventManagerInterface;
use Psr\Log\LoggerInterface;

class EventServiceProvider
{
    public function register(Container $container)
    {
        $container->singleton(EventManagerInterface::class, function (Container $container) {
            $eventManager = new EventManager();

            $eventManager->attach(AppTerminating::NAME, function (AppTerminating $event) use ($container) {
                $logger = $container->get(LoggerInterface::class);
                $logger->info('Event: ' . $event->getName());
            });

            return $eventManager;
        });
    }
}
