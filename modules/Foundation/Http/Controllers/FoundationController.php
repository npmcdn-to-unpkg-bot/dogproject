<?php namespace Modules\Foundation\Http\Controllers;

use Dingo\Api\Routing\Helpers;
use Pingpong\Modules\Routing\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class FoundationController extends Controller {

    use Helpers;

    /**
     * Gets user id from token.
     * @return bool
     */

    public function getAuthenticatedUserId()
    {
        if (! $user = JWTAuth::parseToken()->authenticate())
        {
            return false;
        }
        return $user->id;
    }

    /**
     * Gets all user information from token
     * @return bool
     */

    public function getAuthenticatedUser()
    {
        if (! $user = JWTAuth::parseToken()->authenticate())
        {
            return false;
        }
        return $user;
    }

    /**
     * Gets user role from token
     * @return \Illuminate\Http\JsonResponse
     */

    public function getUserRole()
    {
        if (! $user = JWTAuth::parseToken()->authenticate())
        {
            return response()->json(['user_unauthorized'], 401);
        }
        return response()->json(compact('user'))->getData()->user->role;
    }
	
}