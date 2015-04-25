<?php

namespace Hello;

use Illuminate\Support\ServiceProvider;

class HelloServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    //hello package name 

    public function boot() {
        $this->loadViewsFrom(__DIR__ . '/views', 'hello');
        $this->loadTranslationsFrom(__DIR__ . '/translations', 'hello');
        //$this->loadControllerFrom(__DIR__.'/views', 'hello');
        //$this->loadViewsFrom(__DIR__.'/views', 'hello');
        $this->publishes([
            __DIR__ . '/views' => base_path('resources/views/vendor/hello'),
            __DIR__ . '/config/hello.php' => config_path('hello.php'),
        ]);
        //assets
        $this->publishes([
            __DIR__ . '/assets' => public_path('vendor/hello'),
                ], 'public');

        // Publish a config file
        $this->publishes([
            __DIR__ . '/config/hello.php' => config_path('hello.php')
                ], 'config');

        // Publish your migrations
        $this->publishes([
            __DIR__ . 'database/migrations/' => database_path('/migrations')
                ], 'migrations');

        \Route::any('/hello', function() {
            print_r(\App\User::all());    
            //return view('hello::hello');
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        $this->mergeConfigFrom(__DIR__ . '/config/hello.php', 'hello');
    }

     /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['App\Providers\AppServiceProvider'];
    }
}
