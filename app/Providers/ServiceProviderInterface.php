<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Container\Container;

interface ServiceProviderInterface
{
    public function register(Container $container);
}
