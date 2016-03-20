<?php

namespace Orchestra\Studio\Console;

class ContractMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:contract';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Contract interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Contract interface';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../../stubs/contract.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Contracts';
    }
}
