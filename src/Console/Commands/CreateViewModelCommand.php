<?php

namespace SonTX\LaravelDOD\Console\Commands;

use Illuminate\Support\Str;

class CreateViewModelCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:view-model {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new action class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->init($this->argument('name'), config('laraveldod.view_model_folder', 'ViewModels'));

        $this->createFile(str_replace([
            '{namespace}',
            '{class}',
        ], [
            $this->getNamespace(),
            $this->classname,
        ], $this->getStub('view_model.stub')));
    }
}
