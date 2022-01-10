<?php

namespace LivewireUI\Slideover;

use Illuminate\Support\Facades\View;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LivewireSlideoverServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('livewire-ui-slideover')
            ->hasConfigFile()
            ->hasViews();
    }

    public function bootingPackage(): void
    {
        Livewire::component('livewire-ui-slideover', Slideover::class);

        View::composer('livewire-ui-slideover::slideover', function ($view) {
            if (config('livewire-ui-slideover.include_js', true)) {
                $view->jsPath = __DIR__.'/../public/slideover.js';
            }

            if (config('livewire-ui-slideover.include_css', false)) {
                $view->cssPath = __DIR__ . '/../public/slideover.css';
            }
        });
    }
}
