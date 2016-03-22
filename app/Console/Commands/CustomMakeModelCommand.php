<?php namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CustomMakeModelCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:model:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model from repository';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        if (parent::fire() !== false) {
        }
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/model.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }

    /**
     * Create model in specific path (different from App)
     * @param string $name
     * @return string
     */

    protected function getPath($name)
    {
        if($this->option('path') != '')
        {
            return $this->option('path') . "\\" . $this->argument('name').".php";
        }
    }

    /**
     * Replace namespace in stub
     * @param string $stub
     * @param string $name
     * @return $this
     */

    protected function replaceNamespace(&$stub, $name)
    {
       $stub = str_replace(
            'DummyNamespace', $this->option('path'), $stub
        );

        return $this;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['path', 'p', InputOption::VALUE_NONE, 'Create a new migration file for the model.'],
        ];
    }

    /**
     * Gets the console command arguments.
     * @return array
     */

    protected function getArguments()
    {
        return array(
            array('name', InputArgument::REQUIRED, 'Name of the repository'),
        );
    }
}
