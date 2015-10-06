<?php namespace Orchestra\Studio\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Orchestra\Studio\Traits\PublishFilesTrait;
use Symfony\Component\Console\Input\InputOption;

abstract class PublishCommand extends Command
{
    use PublishFilesTrait;

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(Filesystem $filesystem)
    {
        $this->publishing($filesystem, $this->option('force'));

        $this->info('Publishing complete!');
    }

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
        $this->publishFiles($filesystem, (array) $this->publishes(), $force);
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     *
     * @return $this
     */
    protected function replaceNamespace($stub)
    {
        $stub = str_replace('DummyNamespace', $this->getNamespace(), $stub);
        $stub = str_replace('DummyRootNamespace', trim($this->laravel->getNamespace(), '\\'), $stub);

        return $stub;
    }

    /**
     * Get actual namespace.
     *
     * @return string
     */
    protected function getNamespace()
    {
        return $this->laravel->getNamespace();
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Overwrite any existing files.'],
            ['routes', null, InputOption::VALUE_NONE, 'Publish with routes.'],
        ];
    }

    /**
     * Get publish files/paths.
     *
     * @return array
     */
    abstract protected function publishes();
}
