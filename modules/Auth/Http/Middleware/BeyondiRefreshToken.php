<?php

namespace Modules\Auth\Http\Middleware;

use Closure;
use Dingo\Api\Routing\Helpers;
use Tymon\JWTAuth\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class BeyondiRefreshToken extends BaseMiddleware
{
    use Helpers;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $response = $next($request);

        try {
            $newToken = $this->auth->setRequest($request)->parseToken()->refresh();
        } catch (TokenExpiredException $e) {
            return response()->json(['message' => 'Token has expired','status_code' => 498], 498);
        } catch (JWTException $e) {
            return response()->json(['message' => 'Token invalid','status_code' => 401], 401);
        }

        // send the refreshed token back to the client
        //$response->headers->set('Authorization', 'Bearer ' . $newToken);

        return response()->json(compact('newToken'));
    }
}
