<?php

namespace SonTX\LaravelDOD\Console\Commands;

use Illuminate\Support\Str;

class CreateDTOCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:dto {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new dto class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->init($this->argument('name'), config('laraveldod.dto_folder', 'DataTransferObjects'));

        $this->createFile(str_replace([
            '{namespace}',
            '{class}',
        ], [
            $this->getNamespace(),
            $this->classname,
        ], $this->getStub('dto.stub')));
    }
}
