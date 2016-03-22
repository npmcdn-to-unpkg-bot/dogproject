<?php namespace App\Console\Commands;

use Illuminate\Support\ServiceProvider;
use Pingpong\Modules\Facades\Module;

class registerRepositoryProvider extends ServiceProvider
{

    /**
     * Register all repositories from modules (composer.json)
     */

    public function register()
    {
        $modules = Module::all();
        foreach($modules as $key => $value)
        {
            $json = json_decode(file_get_contents(Module::getModulePath($key)."/composer.json"),true);
            if(array_key_exists("register",$json))
            {
                if (array_key_exists("interface", $json['register'])) {
                    foreach ($json['register']['interface'] as $index => $val)
                    {
                        $this->app->bind($val, $json['register']['repository'][$index]);
                    }
                }
            }
        }
    }
}