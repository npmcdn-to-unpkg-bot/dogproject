<?php namespace Modules\Auth\Http\Middleware;

use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Closure;
/**
 * @SWG\Definition(
 * definition="jwtResponse",
 * @SWG\Response(
 *  response="401",
 *  description="Failed to authenticate because of bad credentials or an invalid authorization header."
 * ),
 * )
**/

class Admin
{
use Helpers;
    public function handle($request, Closure $next)
    {
        if (! $user = JWTAuth::parseToken()->authenticate())
        {
            return response()->json(['user_unauthorized'], 401);
        }
        if($user['attributes']['role']=='admin')
        {
            return $next($request);
        }
        return $this->response->errorUnauthorized('Forbidden');
    }
}