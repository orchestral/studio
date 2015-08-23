<?php namespace Orchestra\Studio\Console;

use Illuminate\Console\Command;
use League\Flysystem\MountManager;
use Illuminate\Filesystem\Filesystem;
use League\Flysystem\Filesystem as Flysystem;
use Symfony\Component\Console\Input\InputOption;
use League\Flysystem\Adapter\Local as LocalAdapter;

abstract class PublishCommand extends Command
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $paths = (array) $this->publishes();

        foreach ($paths as $from => $to) {
            if ($this->files->isFile($from)) {
                $this->publishFile($from, $to);
            } elseif ($this->files->isDirectory($from)) {
                $this->publishDirectory($from, $to);
            } else {
                $this->error("Can't locate path: <{$from}>");
            }
        }

        $this->info('Publishing complete!');
    }

    /**
     * Publish the file to the given path.
     *
     * @param  string  $from
     * @param  string  $to
     *
     * @return void
     */
    protected function publishFile($from, $to)
    {
        if ($this->files->exists($to) && ! $this->option('force')) {
            return;
        }

        $content = $this->buildFile($from);

        $this->createParentDirectory(dirname($to));
        $this->files->put($to, $content);

        $this->status($from, $to, 'File');
    }

    /**
     * Publish the directory to the given directory.
     *
     * @param  string  $from
     * @param  string  $to
     *
     * @return void
     */
    protected function publishDirectory($from, $to)
    {
        $manager = new MountManager([
            'from' => new Flysystem(new LocalAdapter($from)),
            'to'   => new Flysystem(new LocalAdapter($to)),
        ]);

        foreach ($manager->listContents('from://', true) as $file) {
            if ($file['type'] === 'file' && (! $manager->has('to://'.$file['path']) || $this->option('force'))) {
                $content = $this->replaceNamespace($manager->read('from://'.$file['path']));

                $manager->put('to://'.$file['path'], $content);
            }
        }

        $this->status($from, $to, 'Directory');
    }
    /**
     * Create the directory to house the published files if needed.
     *
     * @param  string  $directory
     *
     * @return void
     */
    protected function createParentDirectory($directory)
    {
        if (! $this->files->isDirectory($directory)) {
            $this->files->makeDirectory($directory, 0755, true);
        }
    }

    /**
     * Write a status message to the console.
     *
     * @param  string  $from
     * @param  string  $to
     * @param  string  $type
     *
     * @return void
     */
    protected function status($from, $to, $type)
    {
        $from = str_replace(base_path(), '', realpath($from));
        $to   = str_replace(base_path(), '', realpath($to));

        $this->line('<info>Copied '.$type.'</info> <comment>['.$from.']</comment> <info>To</info> <comment>['.$to.']</comment>');
    }

    /**
     * Build the file with the given path.
     *
     * @param  string  $path
     *
     * @return string
     */
    protected function buildFile($path)
    {
        $stub = $this->files->get($path);

        return $this->replaceNamespace($stub);
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     *
     * @return $this
     */
    protected function replaceNamespace($stub, $name)
    {
        $stub = str_replace('DummyNamespace', $this->getNamespace(), $stub);
        $stub = str_replace('DummyRootNamespace', $this->laravel->getNamespace(), $stub);

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
        ];
    }

    /**
     * Get publish files/paths.
     *
     * @return array
     */
    abstract protected function publishes();
}
