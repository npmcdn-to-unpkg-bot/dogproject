<?php
//
//namespace App\Providers;
//
//use Dingo\Api\Routing\Helpers;
//use Illuminate\Support\Facades\Config;
//use Illuminate\Support\Facades\Session;
//use Illuminate\Support\ServiceProvider;
//use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\DB;
//use Carbon\Carbon;
//
//class ValidatorServiceProvider extends ServiceProvider
//{
//    use Helpers;
//    protected $error;
//
//    ////TODO: Inđekt validator i konfig u klasu, kreirati property failed relation... Podijeliti po modulima validacijske extendove
//    /**
//     * Bootstrap any application services.
//     *
//     * @return void
//     */
//    public function boot()
//    {
//
////        Validator::extend('tokenExpired', function($token, $value, $parameters, $validator) {
////            $date = Carbon::now()->subMinutes(Config::get('auth.password.expire'));
////            if(!DB::table('password_resets')->where('token', $value)->where('created_at','>=',$date)->exists())
////            {
////                //
////            }else {
////                return $value;
////            }
////        },"Your password reset token has expired.");
////
////        Validator::extend('reviewed', function($token, $value, $parameters, $validator) {
////            if(!DB::table('enquiry_entities')->where('review_token', $value)->where('reviewed','=',0)->exists())
////            {
////                //
////            }else {
////                return $value;
////            }
////        },"Review has already been written.");
//
//        Validator::extend('relationExists', function($token, $value, $parameters, $validator)
//        {
//            $relations = explode(",",$value);
//            $definedRelations = Config::get('seller.model.relations');
//            foreach($relations as $relation)
//            {
//                if (!in_array($relation, $definedRelations))
//                {
//
//                    Session::put("relation_error",$relation);
//                    return false;
//                }
//            }
//            return true;
//
//        },"Relation :relation does not exists.");
//
//        Validator::replacer('relationExists', function($message, $attribute, $rule, $parameters)
//        {
//            return str_replace(':relation', Session::get("relation_error"), $message);
//        });
//
//    }
//
//    /**
//     * Register any application services.
//     *
//     * @return void
//     */
//    public function register()
//    {
//
//    }
//}
