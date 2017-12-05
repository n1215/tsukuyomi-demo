<?php
declare(strict_types=1);

namespace App\Providers;

use App\Event\EventManager;
use Illuminate\Container\Container;
use N1215\Tsukuyomi\Event\EventManagerInterface;

class EventManagerServiceProvider
{
    public function register(Container $container)
    {
        $container->singleton(EventManagerInterface::class, EventManager::class);
    }
}
