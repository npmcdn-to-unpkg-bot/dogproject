<?php

namespace Modules\ShelterComments\Providers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class ShelterCommentsValidatorServiceProvider extends ServiceProvider
{
    use Helpers;

    protected $validator;


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Factory $validator)
    {
        $this->validator = $validator;
        $this->validator->extend('shelter_reviewed', function($token, $value, $parameters, $validator) {
            if(!DB::table('shelter_dog_enquiry_entities')->where('review_token', $value)->where('reviewed','=',0)->exists())
            {
                //
            }else {
                return $value;
            }
        },"Review has already been written.");

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
