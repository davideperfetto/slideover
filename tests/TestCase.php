<?php

namespace LivewireUI\Slideover\Tests;

use Livewire\LivewireServiceProvider;
use LivewireUI\Slideover\LivewireSlideoverServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            LivewireServiceProvider::class,
            LivewireSlideoverServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('app.key', 'base64:z1qfUazFM1lzfPy5sFcm8oykb2pQeS0/wuX79GdL3zI=');
    }
}
