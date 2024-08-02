<?php

namespace SonTX\LaravelDOD\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class BaseCommand extends Command
{
    protected array $parts = [];
    protected string $classname = '';
    protected string $basePath = '';
    protected string $parentFolder = '';

    protected function init(string $path, string $parentFolder): void
    {
        $parts = explode('/', $path);
        $parts = array_map(fn ($i) => Str::of($i)->camel()->ucfirst(), $parts);

        $this->classname = array_pop($parts);
        $this->parts = $parts;

        $this->basePath = base_path('app/' . $parentFolder);
        $this->parentFolder = $parentFolder;
    }

    protected function createFile(string $content = '', bool $askToOverride = true): void
    {
        // create folder
        if (!file_exists($this->basePath)) {
            mkdir($this->basePath);
        }

        $folder = $this->basePath;
        foreach ($this->parts as $part) {
            $folder .= '/' . $part;
            if (!file_exists($folder)) {
                mkdir($folder);
            }
        }

        // create file
        $filename = $folder . '/' . $this->classname . '.php';

        if (file_exists($filename) && $askToOverride) {
            $answer = $this->ask('File already exists. Overwrite?', 'y/n');
            if ($answer !== 'y') {
                return;
            }
        }

        file_put_contents($filename, $content);

        $this->info('File created successfully');
        $this->comment($filename);
    }

    protected function getNamespace(): string
    {
        $folder = "App\\" . $this->parentFolder;
        foreach ($this->parts as $part) {
            $folder .= "\\" . $part;
        }

        return $folder;
    }

    protected function resolveStubPath(string $stub): string
    {
        return __DIR__ . "/stubs/" . $stub;
    }

    protected function getStub(string $stub)
    {
        return file_get_contents($this->resolveStubPath($stub));
    }
}
