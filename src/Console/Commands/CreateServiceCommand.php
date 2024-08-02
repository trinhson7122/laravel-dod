<?php

namespace SonTX\LaravelDOD\Console\Commands;

use Illuminate\Support\Str;

class CreateServiceCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->init($this->argument('name'), config('laraveldod.service_folder', 'Services'));

        $this->createFile(str_replace([
            '{namespace}',
            '{class}',
        ], [
            $this->getNamespace(),
            $this->classname,
        ], $this->getStub('service.stub')));
    }
}
