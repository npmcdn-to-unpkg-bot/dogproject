<?php

namespace Modules\Auth\Providers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuthValidatorServiceProvider extends ServiceProvider
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
    public function boot(Factory $validator, Repository $config)
    {
        $this->validator = $validator;
        $this->config = $config;
        $this->validator->extend('tokenExpired', function($token, $value, $parameters, $validator) {
            $date = Carbon::now()->subMinutes($this->config->get('auth.password.expire'));
            if(!DB::table('password_resets')->where('token', $value)->where('created_at','>=',$date)->exists())
            {
                //
            }else {
                return $value;
            }
        },"Your password reset token has expired.");

        $this->validator->extend('AuthUserRelationExists', function($token, $value, $parameters, $validator)
        {
            $relations = explode(",",$value);

            $definedRelations = $this->config->get('auth-user.model.relations.auth');
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

        $this->validator->replacer('AuthUserRelationExists', function($message, $attribute, $rule, $parameters)
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
