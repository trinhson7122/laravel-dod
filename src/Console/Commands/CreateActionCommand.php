<?php

namespace SonTX\LaravelDOD\Console\Commands;

use Illuminate\Support\Str;

class CreateActionCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:action {name}';

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
        $this->init($this->argument('name'), config('laraveldod.action_folder', 'Actions'));

        $this->createFile(str_replace([
            '{namespace}',
            '{class}',
        ], [
            $this->getNamespace(),
            $this->classname,
        ], $this->getStub('action.stub')));
    }
}
