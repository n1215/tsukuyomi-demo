<?php
declare(strict_types=1);

namespace App\Providers;

use N1215\Tsukuyomi\Event\AppTerminating;
use N1215\Tsukuyomi\Event\EventManagerInterface;
use N1215\Tsukuyomi\Providers\EventManagerServiceProvider;

class EventServiceProvider extends EventManagerServiceProvider
{
    protected function registerEvents(EventManagerInterface $eventManager)
    {
        $eventManager->attach(AppTerminating::NAME, function (AppTerminating $event) {
            // do stuff
        });
    }
}
