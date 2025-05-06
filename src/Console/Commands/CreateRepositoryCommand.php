<?php

namespace SonTX\LaravelDOD\Console\Commands;

use Illuminate\Support\Str;

class CreateRepositoryCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name} {--no-model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class and interface';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $isNoModel = $this->option('no-model');

        if (!$isNoModel) {
            $this->init('Models/Repo/' . $this->argument('name'), config('laraveldod.repository_folder', 'Repositories'));
            $this->createFile(str_replace([
                '{namespace}',
                '{class}',
                '{model}',
                '{model_var}',
            ], [
                $this->getNamespace(),
                $this->classname,
                Str::of($this->classname)->remove("Repository"),
                Str::of($this->classname)->camel(),
            ], $this->getStub('repository.stub')));

            $this->init('Models/Interfaces/' . $this->argument('name'), config('laraveldod.repository_folder', 'Repositories'));
            $this->classname = $this->classname . 'Interface';
            $this->createFile(str_replace([
                '{namespace}',
                '{class}',
                '{model}',
                '{model_var}',
            ], [
                $this->getNamespace(),
                $this->classname,
                Str::of($this->classname)->remove("Repository")->remove("Interface"),
                Str::of($this->classname)->remove("Repository")->remove("Interface")->camel(),
            ], $this->getStub('repository_interface.stub')), false);
        }
        else {
            $this->init($this->argument('name'), config('laraveldod.repository_folder', 'Repositories'));
            $this->createFile(str_replace([
                '{namespace}',
                '{class}',
                '{model}',
                '{model_var}',
            ], [
                $this->getNamespace(),
                $this->classname,
                Str::of($this->classname)->remove("Repository"),
                Str::of($this->classname)->camel(),
            ], $this->getStub('repository_no_model.stub')));

            $this->classname = $this->classname . 'Interface';

            $this->createFile(str_replace([
                '{namespace}',
                '{class}',
                '{model}',
                '{model_var}',
            ], [
                $this->getNamespace(),
                $this->classname,
                Str::of($this->classname)->remove("Repository")->remove("Interface"),
                Str::of($this->classname)->remove("Repository")->remove("Interface")->camel(),
            ], $this->getStub('repository_interface_no_model.stub')), false);
        }
    }
}
