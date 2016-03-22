<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Config;
use Pingpong\Modules\Facades\Module;
use Pingpong\Modules\Json;
use Illuminate\Support\Facades\File;


class RepositoryMakeCommand extends GeneratorCommand
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'make:repository {--model=} {--base=} {--dynamic} {name} {moduleName}';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Create a new repository';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';

    /**
     * Module namespace
     * @var
     */

    protected $moduleNamespace;

    /**
     * Repository namespace
     * @var
     */

    protected $repositoryNamespace;

    /**
     * Property for holding json file(composer.json from module) data
     * @var
     */

    protected $jsonFile;


    /**
     * Check if base repository exists.
     */

    protected function checkIfBaseExist()
    {
        $namespacePath = Config::get('modules.paths.base') . $this->option('base');
        $path = $this->getPathFromNamespace($namespacePath);
        dd($path);
        if (!file_exists($path))
        {
            $this->error('Base repository does not exists!');
            die;
        }
    }

    /**
     *  Gets file path from namespace
     * @param $name
     * @return string
     */

    protected function getPathFromNamespace($name)
    {
        $name = str_replace($this->laravel->getNamespace(), '', $name);
        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . '.php';
    }


    /**
     * Check if module exists.
     */

    protected function checkIfModuleExists()
    {
        if(Module::has($this->argument('moduleName')))
        {
            return true;
        }
        return false;
    }

    /**
     * Gets modules folder path (from config/modules.php) and creates Repository and models folder
     * @return string
     */

    protected function modulePath()
    {
        return Config::get('modules.paths.modules')."\\".$this->argument('moduleName');
    }

    /**
     * Choose which stub to use
     * @return string
     */

    protected function getStub()
    {
        if($this->option('base') && $this->option('model'))
        {
            return __DIR__ . Config::get('modules.stubs.repositoryCreation.repositoryExtendsEntity');
        }
        else if($this->option('base'))
        {
            return __DIR__ . Config::get('modules.stubs.repositoryCreation.repositoryExtends');
        }else if($this->option('model'))
        {
            return __DIR__ . Config::get('modules.stubs.repositoryCreation.repositoryEntity');
        }else
        {
            return __DIR__ . Config::get('modules.stubs.repositoryCreation.repository');
        }
    }

    /**
     * Gets user defined repository name.
     * @return string
     */

    protected function getNameInput()
    {
        return $this->argument('name') . "Repository";
    }

    /**
     * Gets path for creating repository, if module used create in module namespace, if not create in App based on user input
     * @param string $name
     * @return string
     */

    protected function getPath($name)
    {
        return $this->repositoryNamespace . "\\".$this->argument('name') . "Repository.php";
    }

    /**
     * Gets module name from user input
     * @return array|string
     */

    protected function getModuleNameInput()
    {
        return $this->argument('moduleName');
    }


    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(
            'DummyNamespace', $this->repositoryNamespace, $stub
        );

        $stub = str_replace(
            '{{InterfaceNamespace}}', $this->getNamespaceFromConfig('modules.paths.generator.contract'), $stub  //iz konfiga
        );

        if($this->option('model'))
        {
            $this->replaceModel($stub,$name);
        }

        if($this->option('base'))
        {
            $this->replaceBase($stub,$name);
        }

        if($this->option('base') && $this->option('model'))
        {
            $this->replaceModel($stub,$name);
            $this->replaceBase($stub,$name);
        }
        return $this;
    }

    /**
     * For creating repository with model (replace model data in stub)
     * @param $stub
     * @param $name
     * @return $this
     */

    protected function replaceModel(&$stub)
    {
        $stub = str_replace(
            '{{EntityNamespace}}', $this->getNamespaceFromConfig('modules.paths.generator.model'), $stub  //iz konfiga
        );

        $stub = str_replace(
            '{{entity}}', $this->option('model') . "Model", $stub
        );

        $stub = str_replace(
            '{{property}}', "model", $stub
        );

        if(!$this->option('dynamic'))
        {
            $implementation = File::get(__DIR__ . Config::get('modules.stubs.repositoryCreation.implementation'));
            $implementation = str_replace('{{entity}}', "model", $implementation);
            $stub = str_replace(
                '{{implementation}}', $implementation, $stub
            );
        }else
        {
            $stub = str_replace(
                '{{implementation}}', "", $stub
            );
        }
        return $this;
    }

    /**
     * Replace base name in stub for extending (repository extends base)
     * @param $stub
     * @return $this
     */

    protected function replaceBase(&$stub)
    {
        $stub = str_replace(
            '{{baseName}}',$this->option('base'), $stub
        );
        $stub = str_replace(
            '{{basePath}}', Config::get('modules.paths.base'), $stub
        );
        return $this;

    }


    protected function getNamespaceFromConfig($config)
    {
        return str_replace("/","\\",$this->moduleNamespace . "\\" . Config::get($config));
    }


    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        //dd($this->option());
        if($this->checkIfModuleExists())
        {
            $this->jsonFile = new Json($this->modulePath() . "\\composer.json");
            $jsonData = $this->jsonFile->get('autoload');
            $this->moduleNamespace = substr(key($jsonData['psr-4']), 0, -1);
            $this->repositoryNamespace = $this->getNamespaceFromConfig('modules.paths.generator.repository');
        }else
        {
            $this->error('Module does not exists!');
        }
        if($this->option('base'))
        {
            $this->checkIfBaseExist();
        }
        if (parent::fire() !== false)
        {
            if ($this->option('model'))
            {
                $this->call('make:model:repository', ['name' => $this->option('model') . "Model", "-p" => $this->moduleNamespace. "\\Repositories\\Entities"  ]);
            }

            //writes to json file, under [register][repository] array

            $jsonData = $this->jsonFile->getAttributes();
            if((array_key_exists("register",$jsonData)) && (array_key_exists("repository",$jsonData['register'])))
            {
                array_push( $jsonData["register"]["repository"],$this->repositoryNamespace."\\".$this->argument('name')."Repository");
            }else if((array_key_exists("register",$jsonData)))
            {
                $jsonData["register"] += array("repository" => [$this->repositoryNamespace . "\\" . $this->argument('name') . "Repository"]);
            }else
            {
                $jsonData["register"] = array("repository" => [$this->repositoryNamespace . "\\" . $this->argument('name') . "Repository"]);
            }
            $this->jsonFile->set('register',$jsonData["register"]);
            $this->jsonFile->save();
        }
    }

}
