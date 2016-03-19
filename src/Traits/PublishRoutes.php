<?php namespace Orchestra\Studio\Traits;

use Illuminate\Filesystem\Filesystem;

trait PublishRoutes
{
    /**
     * Appends routes.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $filesystem
     * @param  string|null  $route
     *
     * @return void
     */
    protected function publishRoute(Filesystem $filesystem, $route)
    {
        if (is_null($route)) {
            return ;
        }

        $routeFile = app_path('Http/routes.php');

        if ($filesystem->exists($routeFile) && $filesystem->exists($route)) {
            $filesystem->append($routeFile, $filesystem->get($route));

            $this->line('<info>Append routes from</info> <comment>['.$route.']</comment>');
        }
    }

    /**
     * Write a string as standard output.
     *
     * @param  string  $string
     *
     * @return void
     */
    abstract public function line($string);

    /**
     * Get routes file.
     *
     * @return string|null
     */
    abstract protected function getRoutesFile();
}
