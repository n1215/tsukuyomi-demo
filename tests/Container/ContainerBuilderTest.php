<?php
declare(strict_types=1);

namespace App\Container;

use App\Providers\ServiceProviderInterface;
use Illuminate\Container\Container;
use PHPUnit\Framework\TestCase;

class ContainerBuilderTest extends TestCase
{
    public function test_boot()
    {
        $containerBuilder = new ContainerBuilder([
            HogeServiceProvider::class,
            FugaServiceProvider::class,
        ]);

        $container = $containerBuilder->build();

        $this->assertInstanceOf(Container::class, $container);
        $this->assertEquals(HogeServiceProvider::class, $container->get('hoge'));
        $this->assertEquals(FugaServiceProvider::class, $container->get('fuga'));
    }

    public function test_constructor_throws_exception_when_non_service_provider_class_given()
    {
        $this->expectException(\InvalidArgumentException::class);
        new ContainerBuilder([
            NonServiceProvider::class,
        ]);
    }
}

class HogeServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container->bind('hoge',  function () { return self::class; });
    }
}

class FugaServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container->bind('fuga', function() { return self::class; });
    }
}

class NonServiceProvider
{
    public function register(Container $container)
    {
    }
}
