<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Container\Container;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use N1215\Tsukuyomi\FrameworkInterface;
use Psr\Log\LoggerInterface;

class LogServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container->singleton(LoggerInterface::class, function (Container $container) {
            /** @var FrameworkInterface $framework */
            $framework = $container->get(FrameworkInterface::class);

            $logger = new Logger('app');
            $logger->pushHandler(new StreamHandler($framework->path('storage/logs/app.log')));
            return $logger;
        });
    }
}
