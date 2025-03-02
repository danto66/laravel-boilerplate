<?php

namespace App\Console\Commands\Make;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'make:dto', description: 'Create a new Data Transfer Object')]
class DtoCommand extends GeneratorCommand
{
    protected $type = 'Data Transfer Object';

    protected function getStub()
    {
        return $this->resolveStubPath('/stubs/dto.stub');
    }

    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . $stub;
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\DataTransferObjects';
    }
}
