<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Container\Container;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use N1215\Tsukuyomi\FrameworkInterface;

class ValidationServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container->singleton(Translator::class, function (Container $app) {
            /** @var FrameworkInterface $framework */
            $framework = $app->make(FrameworkInterface::class);
            $path = $framework->path('resources/lang');
            return new \Illuminate\Translation\Translator(new FileLoader(new Filesystem(), $path), 'en');
        });
    }
}
