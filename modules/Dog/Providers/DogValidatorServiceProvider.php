<?php


namespace Modules\Dog\Providers;


use Dingo\Api\Routing\Helpers;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Support\ServiceProvider;

class DogValidatorServiceProvider extends ServiceProvider
{
    use Helpers;

    protected $validator;

    protected $config;

    protected $error;


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Factory $validator, Repository $config)
    {
        $this->validator = $validator;
        $this->config = $config;
        $this->validator->extend('DogRelationExists', function($token, $value, $parameters, $validator)
        {
            $relations = explode(",",$value);
            $definedRelations = $this->config->get('dog.model.relations.dog');
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

        $this->validator->replacer('DogRelationExists', function($message, $attribute, $rule, $parameters)
        {
            return str_replace(':relation', $this->error, $message);
        });

        $this->validator->extend('DogRescueRelationExists', function($token, $value, $parameters, $validator)
        {
            $relations = explode(",",$value);
            $definedRelations = $this->config->get('dog.model.relations.rescue');
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

        $this->validator->replacer('DogRescueRelationExists', function($message, $attribute, $rule, $parameters)
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
