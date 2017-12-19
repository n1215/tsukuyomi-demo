<?php
declare(strict_types=1);

namespace App\Container;

use App\Providers\ServiceProviderInterface;
use Illuminate\Container\Container;

class ContainerBuilder
{
    /** @var ServiceProviderInterface[] */
    private $providers;

    /**
     * @param string[] $providerClasses
     */
    public function __construct(array $providerClasses)
    {
        $this->providers = [];
        foreach($providerClasses as $providerClass) {
            $this->addProvider($providerClass);
        }
    }

    private function addProvider(string $providerClass)
    {
        $provider = new $providerClass();
        if (!$provider instanceof ServiceProviderInterface) {
            throw new \InvalidArgumentException('provider must implement' . ServiceProviderInterface::class . '.');
        }

        $this->providers[] = $provider;
    }

    public function build(): Container
    {
        $container = new Container();
        foreach ($this->providers as $provider) {
            $provider->register($container);
        }

        return $container;
    }
}
