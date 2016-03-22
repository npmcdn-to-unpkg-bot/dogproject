<?php

namespace Modules\Shelter\Providers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Support\ServiceProvider;

class ShelterValidatorServiceProvider extends ServiceProvider
{
    use Helpers;


    protected $validator;

    protected $config;


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Factory $validator, Repository $config)
    {
        $this->validator = $validator;
        $this->config = $config;
        $this->validator->extend('ShelterRelationExists', function($token, $value, $parameters, $validator)
        {
            $relations = explode(",",$value);
            $definedRelations = $this->config->get('shelter.model.relations.shelter');
            foreach($relations as $relation)
            {
                if (!in_array($relation, $definedRelations))
                {
                    $this->error = $relation;
                    return false;
                }
            }
            return true;

        },"Relation :relation does not exists.");

        $this->validator->replacer('ShelterRelationExists', function($message, $attribute, $rule, $parameters)
        {
            return str_replace(':relation', $this->error, $message);
        });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
