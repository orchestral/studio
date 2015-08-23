<?php namespace Orchestra\Studio\Console;

class AuthControllerMakeCommand extends PublishCommand
{
    /**
     * Get actual namespace.
     *
     * @return string
     */
    protected function getNamespace()
    {
        return $this->laravel->getNamespace().'\Http\Controllers\Auth';
    }

    /**
     * Get publish files/paths.
     *
     * @return array
     */
    abstract protected function publishes()
    {
        $stub = __DIR__.'/../../stubs';

        return [
            "{$stub}/controllers/auth/authenticate.stub" => app_path('Http/Controllers/Auth/AuthenticateController.php'),
            "{$stub}/controllers/auth/deauthenticate.stub" => app_path('Http/Controllers/Auth/DeauthenticateController.php'),
            "{$stub}/controllers/auth/register.stub" => app_path('Http/Controllers/Auth/RegisterController.php'),

            "{$stub}/views/auth" => base_path('resources/views/auth'),
        ];
    }
}
