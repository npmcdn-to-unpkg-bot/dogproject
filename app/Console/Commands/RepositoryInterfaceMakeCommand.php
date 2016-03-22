<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Pingpong\Modules\Json;
use Pingpong\Modules\Facades\Module;
use Illuminate\Support\Facades\Config;

class RepositoryInterfaceMakeCommand extends GeneratorCommand
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'make:repository:interface {--methods=} {name} {moduleName}';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Create a new repository interface.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository interface';

    /**
     * Modules folder path from config/modules.php
     * @var
     */

    protected $modulePath;

    /**
     * Modules namespace (comes from composer.json from modules)
     * @var
     */

    protected $moduleNamespace;

    /**
     * Interface namespace
     * @var
     */

    protected $interfaceNamespace;

    /**
     * Property that points to module modules.json file
     * @var
     */

    protected $jsonFile;

    /**
     * Dynamic methods for interface
     * @var
     */

    protected $dynamicMethods;

    /**
     * Get module path from config (config/modules.php) and creates repository  and interface folder
     * @return string
     */

    protected function modulePath()
    {
        $this->modulePath = Config::get('modules.paths.modules')."\\".$this->argument('moduleName');
        return $this->modulePath;
    }

    /**
     * Checks if module exists.
     */

    protected function checkIfModuleExists()
    {
        //dd(Module::has('Cars'));
        if(Module::has($this->argument('moduleName')))
        {
            return true;
        }
        return false;
    }

    /**
     * Get path for creating interface
     * @param string $name
     * @return string
     */

    protected function getPath($name)
    {
        return $this->interfaceNamespace . "\\" . $this->argument('name') . "RepositoryInterface.php";
    }

    /**
     * Gets stub template for creating
     * @return string
     */

    protected function getStub()
    {
        if($this->option('methods'))
        {
            return __DIR__ . Config::get('modules.stubs.repositoryCreation.repositoryInterfaceOption');
        }else
        {
            return __DIR__ . Config::get('modules.stubs.repositoryCreation.repositoryInterface');
        }
    }

    /**
     * Gets name for creating, adds "RepositoryInterface" to the end of user specified name (Overriding method).
     * @return string
     */

    protected function getNameInput()
    {
        return $this->argument('name') . "RepositoryInterface";
    }

    /**
     * Replace namespace in stub, if module is not used, use default namespace from user input (App namespace)
     * @param string $stub
     * @param string $name
     * @return $this
     */

    protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(
            'DummyNamespace', $this->interfaceNamespace, $stub
        );

        if($this->option('methods'))
        {
            $temp='';
            foreach($this->dynamicMethods as $method)
            {
                $temp = $temp . "public function " . $method ."();\n";
                $temp = $temp . "\n\t";
            }
            $stub = str_replace(
                '{{options}}', $temp, $stub
            );
        }
        return $this;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
            if($this->checkIfModuleExists())
            {
                $this->dynamicMethods = explode(',',$this->option('methods'));
                $this->modulePath = $this->modulePath();
                $this->jsonFile = new Json($this->modulePath . "\\composer.json");
                $jsonData = $this->jsonFile->get('autoload');
                $this->moduleNamespace = substr(key($jsonData['psr-4']), 0, -1);
                $this->interfaceNamespace = $this->moduleNamespace . "\\" . Config::get('modules.paths.generator.contract');
                $this->interfaceNamespace = str_replace("/","\\",$this->interfaceNamespace);
            }else
            {
                $this->error('Module does not exists!');
            }
        if (parent::fire() !== false)
        {
            $jsonData = $this->jsonFile->getAttributes();
            if((array_key_exists("register",$jsonData)) && (array_key_exists("interface",$jsonData['register'])))
            {
                array_push( $jsonData["register"]["interface"],$this->interfaceNamespace."\\".$this->argument('name')."RepositoryInterface");
            }else if((array_key_exists("register",$jsonData)))
            {
                //array_push( $jsonData["register"],array("interface" => [$this->interfaceNamespace . "\\" . $this->argument('name') . "RepositoryInterface.php"]));
                $jsonData["register"] += array("interface" => [$this->interfaceNamespace . "\\" . $this->argument('name') . "RepositoryInterface"]);
            }else
            {
                $jsonData["register"] = array("interface" => [$this->interfaceNamespace . "\\" . $this->argument('name') . "RepositoryInterface"]);
            }
            $this->jsonFile->set('register',$jsonData["register"]);
            $this->jsonFile->save();

        }
    }

}
