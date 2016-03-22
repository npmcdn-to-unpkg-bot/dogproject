<?php

namespace Modules\Seller\Providers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class SellerValidatorServiceProvider extends ServiceProvider
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
        $this->validator->extend('SellerRelationExists', function($token, $value, $parameters, $validator)
        {
            $relations = explode(",",$value);
            $definedRelations = $this->config->get('seller.model.relations.seller');
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

        $this->validator->replacer('SellerRelationExists', function($message, $attribute, $rule, $parameters)
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
