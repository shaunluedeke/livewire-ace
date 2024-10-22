<?php


namespace Panikka\LivewireAce;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LivewireAceServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . "/../resources/views", "livewire-ace");
        $this->mergeConfigFrom(__DIR__ . "/../config/config.php", 'ace');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('ace.php'),
            ], 'livewire-ace-config');
            $this->publishes([
                __DIR__ . '/../node_modules/ace-builds/src-min-noconflict' => public_path('vendor/livewire-ace'),
            ]);
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/livewire-ace'),
            ], 'livewire-ace-views');
        }
        

        Blade::directive('livewireAceScripts', function ($mode = null, $theme = null) {
            $mode ??= config('ace.defaults.mode');
            $theme ??= config('ace.defaults.theme');
            if ($theme !== null) {
                $theme = 'theme-' . $theme;
            }
            $extensions = config('ace.extensions');
            return view('livewire-ace::script', compact('mode', 'theme', 'extensions'));
        });
    }

}
