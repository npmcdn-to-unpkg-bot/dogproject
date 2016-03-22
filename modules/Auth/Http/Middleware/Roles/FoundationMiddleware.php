<?php namespace Modules\Auth\Http\Middleware\Roles;

use Dingo\Api\Routing\Helpers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Closure;
use Illuminate\Support\Facades\DB;


abstract class FoundationMiddleware
{
    use Helpers;

    protected $role;

    protected $errorMessage;

    protected $type;


    public function __construct($role, $error, $type = "any")
    {
        $this->role = $role;
        $this->errorMessage = $error;
        $this->type = $type;
    }

    public function handle($request, \Closure $next)
    {

        if (! $user = JWTAuth::parseToken()->authenticate())
        {
            return response()->json(['user_unauthorized'], 401);
        }

        $type=DB::table("seller_account_entities")->where('user_id','=',$user['attributes']['id'])->first();
        if($user['attributes']['role'] == $this->role)
        {
            if($this->type == "any")
            {
                return $next($request);
            }
            if(($this->type == $type->type)&&($this->role == 1))
            {
                return $next($request);
            }

        }
        return $this->response->errorUnauthorized($this->errorMessage);
    }
}