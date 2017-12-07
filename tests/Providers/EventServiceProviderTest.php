<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Container\Container;
use N1215\Tsukuyomi\Event\AppTerminating;
use N1215\Tsukuyomi\Event\EventManager;
use N1215\Tsukuyomi\Event\EventManagerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;

class EventServiceProviderTest extends TestCase
{
    public function test_register()
    {
        $container = new Container();
        $container->bind(LoggerInterface::class, function () {
           $logger = $this->getMockBuilder(LoggerInterface::class)->getMock();

           $logger->expects($this->once())
               ->method('info')
               ->with('Event: app.terminating');

           return $logger;
        });

        $provider = new EventServiceProvider();
        $provider->register($container);

        $eventManager = $container->get(EventManagerInterface::class);

        $this->assertInstanceOf(EventManager::class, $eventManager);

        $request = new ServerRequest();
        $response = new Response();
        $eventManager->trigger(new AppTerminating($request, $response));
    }
}
