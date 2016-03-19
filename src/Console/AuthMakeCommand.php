<?php namespace Orchestra\Studio\Console;

use Illuminate\Filesystem\Filesystem;
use Orchestra\Studio\Traits\PublishRoutes;

class AuthMakeCommand extends PublishCommand
{
    use PublishRoutes;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:auth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold basic login and registration views and routes';

    /**
     * Publishing command.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $filesystem
     * @param  bool    $force
     *
     * @return void
     */
    protected function publishing(Filesystem $filesystem, $force = false)
    {
        parent::publishing($filesystem, $force);

        if ($this->option('routes') || $this->confirm('Do you wish to append routes? [y|N]')) {
            $this->publishRoute($filesystem, $this->getRoutesFile());
        }
    }

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
            "{$stub}/controllers/auth/password.stub"       => app_path('Http/Controllers/Auth/PasswordController.php'),

            "{$stub}/views/layouts" => base_path('resources/views/layouts'),
            "{$stub}/views/auth"    => base_path('resources/views/auth'),
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
