<?php

namespace Modules\Association\Providers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AssociationValidatorServiceProvider extends ServiceProvider
{
    use Helpers;


    protected $validator;

    protected $config;




    ////TODO: Inđekt validator i konfig u klasu, kreirati property failed relation... Podijeliti po modulima validacijske extendove
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Factory $validator, Repository $config, Request $request)
    {
        $this->validator = $validator;
        $this->config = $config;
        $this->validator->extend('verifiedBreeder', function($token, $value, $parameters, $validator) {
            $id = DB::table('user_account_entities')->where('email', $value)->first();
            if(!DB::table('seller_account_entities')->where('user_id', $id->id)->where("type","verified")->exists())
            {
                //
            }else {
                return $value;
            }
        },"User is not verified breeder.");


        $this->validator->extend('suburb_state', function($token, $value, $parameters, $validator) use ($request) {
            if(!DB::table('location_suburb_entities')->where('state_id', $request->input('state_id'))->where("id",$value)->exists())
            {
                //
            }else {
                return $value;
            }
        },"Suburb doesnt belong to that state.");


        $this->validator->extend('AssociationRelationExists', function($token, $value, $parameters, $validator)
        {
            $relations = explode(",",$value);
            $definedRelations = $this->config->get('association.model.relations.association');
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

        $this->validator->replacer('AssociationRelationExists', function($message, $attribute, $rule, $parameters)
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
