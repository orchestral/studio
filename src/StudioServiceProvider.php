<?php namespace Orchestra\Studio;

use Illuminate\Support\ServiceProvider;

class StudioServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $generators = [
        'ContractMake'  => 'orchestra.studio.command.contract.make',
        'FilterMake'    => 'orchestra.studio.command.filter.make',
        'MenuMake'      => 'orchestra.studio.command.menu.make',
        'ValidatorMake' => 'orchestra.studio.command.validator.make',
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        foreach (array_keys($this->generators) as $command) {
            $class = "Orchestra\\Studio\\{$command}Command";
            $name  = $this->generators[$command];

            $this->app->singleton($name, $class);
        }

        $this->commands(array_values($this->generators));
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array_values($this->generators);
    }
}
