<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Config;


use Pingpong\Modules\Facades\Module;

class ModuleMakeRepositoryCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'module:make:repository {--methods=} {--model=} {--base=} {name} {moduleName}';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Create a complete repository with dependecies.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository complete';

    protected $jsonFile;



    protected function getStub()
    {
        return __DIR__ . Config::get('modules.stubs.repositoryCreation.repositoryInterfaceOption');
    }

//    protected function checkIfModuleExists()
//    {
//        if(Module::has($this->argument('moduleName')))
//        {
//            return true;
//        }
//        return false;
//    }
//
//
//    protected function getPath($moduleNameArgument)
//    {
//
//    }

    protected function modulePath()
    {
        return Config::get('modules.paths.modules')."\\".$this->argument('moduleName');
    }


    public function fire()
    {
        //dd($this->option("methods"));

        //if (parent::fire() !== false) {
            //dd("tu sam");
            if ($this->option("methods")) {
                //dd($this->option("methods"));
                $this->call('make:repository:interface', ['name' => $this->argument('name'), 'moduleName' => $this->argument('moduleName'), "--methods" => $this->option('methods')]);
            } else {
                $this->call('make:repository:interface', ['name' => $this->argument('name'), 'moduleName' => $this->argument('moduleName')]);
            }

            if ($this->option("model") && $this->option("base")) {
                $this->call('make:repository', ['name' => $this->argument('name'), 'moduleName' => $this->argument('moduleName'), "--model" => $this->option('model'), "--base" => $this->option('base')]);

            } else if ($this->option("model") && $this->option("methods")) {
                //dd("tu sam");
                $this->call('make:repository', ['name' => $this->argument('name'), 'moduleName' => $this->argument('moduleName'), "--model" => $this->option('model'), "--dynamic" => true]);
            } else if ($this->option("model")) {
                $this->call('make:repository', ['name' => $this->argument('name'), 'moduleName' => $this->argument('moduleName'), "--model" => $this->option('model')]);
            } else if ($this->option("base")) {
                $this->call('make:repository', ['name' => $this->argument('name'), 'moduleName' => $this->argument('moduleName'), "--base" => $this->option('base')]);
            } else {
                $this->call('make:repository', ['name' => $this->argument('name'), 'moduleName' => $this->argument('moduleName')]);
            }
            //dd( file_get_contents($this->modulePath()."\Providers\\".$this->argument('moduleName')."ServiceProvider.php"));

//        $this->jsonFile = new Json($this->modulePath() . "\\composer.json");
//        $jsonData = $this->jsonFile->get('autoload');
//        $this->moduleNamespace = substr(key($jsonData['psr-4']), 0, -1);
//        $this->repositoryNamespace = $this->getNamespaceFromConfig('modules.paths.generator.repository');


            //dd("u sam");
//        $filename = $this->modulePath()."\Providers\\".$this->argument('moduleName')."ServiceProvider.php"; // the file to change
//        //$contents
//
//        //$search = 'public function register() {';
//        //dd(bin2hex($search));
//        //{
//        //';
//
//        $search = "{{change}}"; // the content after which you want to insert new stuff
//
//        $insert = '\tpublic function register()\n
//        \t{\t\t\n
//        \t\t//\n'; // your new stuff
//
//        $replace = $search. "\n". "bla";
//        //dd(strpos($search, $findme));
//        dd(str_replace($search, $replace, file_get_contents($filename)));
//
//        file_put_contents($filename, str_replace($search, $replace, file_get_contents($filename)));
//

        }


}
