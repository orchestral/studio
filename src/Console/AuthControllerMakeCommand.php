<?php namespace Orchestra\Studio\Console;

class AuthControllerMakeCommand extends PublishCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:auth-controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create auth boilerplate controllers and views';

    /**
     * Get actual namespace.
     *
     * @return string
     */
    protected function getNamespace()
    {
        return trim($this->laravel->getNamespace(), '\\').'\Http\Controllers\Auth';
    }

    /**
     * Get publish files/paths.
     *
     * @return array
     */
    protected function publishes()
    {
        $stub = __DIR__.'/../../stubs';

        return [
            "{$stub}/controllers/auth/authenticate.stub"   => app_path('Http/Controllers/Auth/AuthenticateController.php'),
            "{$stub}/controllers/auth/deauthenticate.stub" => app_path('Http/Controllers/Auth/DeauthenticateController.php'),
            "{$stub}/controllers/auth/register.stub"       => app_path('Http/Controllers/Auth/RegisterController.php'),

            "{$stub}/views/app.blade.php" => base_path('resources/views/app.blade.php'),
            "{$stub}/views/auth"          => base_path('resources/views/auth'),
        ];
    }

    /**
     * Get routes file.
     *
     * @return array
     */
    protected function getRoutesFile()
    {
        return __DIR__.'/../../stubs/routes/auth.stub';
    }
}
