<?php

namespace AshrafSaeed\MakeFile;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class MakeFileClient extends GeneratorCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:file {name : file name with extention} {--path= : path where it should be add} {--resource= : resource name such as controller, modle, Facade, Service Provider } ';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create files for Design patrens such as Factory, Builder, Prototype, Singleton, Adapter, Bridge and Repository Pattrens';
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:file {name : file name with extention} {--path= : path where it should be add} {--resource= : resource name such as controller, modle, Facade, Service Provider }';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    private $resource;

    /**
     * Reset database configuration.
     */
    public function handle() {

        $filename = $this->argument('name');

        $isPhpFile = Str::endsWith($filename, '.php');

        if(!$isPhpFile) {

            $this->error('its not a php file');
        
        } else {

            $path = $this->option('path');
            $this->resource = $this->option('resource');
            
            $this->makeDirectory($path);

            $output = $this->files->put($path.$filename, $this->buildClass($filename));

            $this->info($filename.' resource created successfully.');

        }
    }


    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }


    protected function qualifyFileName($name) {

        return Str::endsWith($name, '.php');

    }

    protected function buildClass($name) {

        $stub = $this->files->get($this->getStubByType($this->resource));

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    protected function getStubByType($type) {

        if($type == 'provider')
            return __DIR__.'/stubs/provider.stub';
        
        return __DIR__.'/stubs/class.stub';

    }

    protected function getStub() {

        return __DIR__.'/stubs/class.stub';

    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name) {

        $stub = str_replace( 'DummyNamespace', $this->getNamespace($name), $stub);
        return $this;
    }

    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace('DummyClass', $class, $stub);
    }


}