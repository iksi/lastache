<?php namespace Iksi\Lastache;

use Illuminate\Support\ServiceProvider;

class LastacheServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('iksi/lastache');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Lastache', 'Iksi\Lastache\Lastache');
            $loader->alias('LastacheLayout', 'Iksi\Lastache\LastacheLayout');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('lastache');
    }

}