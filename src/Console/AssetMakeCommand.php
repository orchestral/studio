<?php

namespace Orchestra\Studio\Console;

use Illuminate\Filesystem\Filesystem;

class AssetMakeCommand extends PublishCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:asset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold basic asset from Orchestra Foundation';

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
        $base       = realpath(__DIR__.'/../../../');
        $stub       = "{$base}/studio/stubs";
        $foundation = "{$base}/foundation/resources";

        return [
            "{$stub}/.bowerrc"    => base_path('.bowerrc'),
            "{$stub}/bower.json"  => base_path('bower.json'),
            "{$stub}/gulpfile.js" => base_path('gulpfile.js'),
            "{$stub}/paths.js"    => base_path('paths.js'),

            "{$foundation}/assets/img"    => base_path('resources/assets/img'),
            "{$foundation}/assets/css"    => base_path('resources/assets/css'),
            "{$foundation}/assets/fonts"  => base_path('resources/assets/fonts'),
            "{$foundation}/assets/less"   => base_path('resources/assets/less'),
            "{$foundation}/assets/vendor" => base_path('resources/assets/vendor'),
            "{$foundation}/js"            => base_path('resources/js'),
        ];
    }
}
