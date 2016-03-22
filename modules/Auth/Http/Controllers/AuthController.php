<?php namespace Modules\Auth\Http\Controllers;

use Illuminate\Config\Repository as Config;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Http\Requests\AuthTokenRequest;
use Modules\Auth\Http\Requests\AuthTokenValidateRequest;
use Modules\Auth\Http\Requests\AuthUserPasswordRequest;
use Modules\Auth\Http\Requests\AuthUserRequest;
use Modules\Auth\Http\Requests\AuthUserWithRequest;
use Modules\Auth\Repositories\Contracts\AuthRepositoryInterface;
use Modules\Auth\ResetsApiPasswords;
use Modules\Foundation\Http\Controllers\FoundationController;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Carbon\Carbon;


class AuthController extends FoundationController {

    protected $auth;

   use ResetsApiPasswords;

	public function __construct(AuthRepositoryInterface $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Get credentials for authentication
     *
     * @param AuthTokenRequest $request
     * @return array
     */

    protected function getCredentials(AuthTokenRequest $request)
    {
        return $request->only('email', 'password');
    }

    /**
     * Get keys allowed for use on user update
     *
     * @param $request
     * @return mixed
     */


    protected function getUpdateUserInformation($request)
    {
        return $request->only(['first_name','last_name','email','contact_number']);
    }

    /**
     * Get keys allowed for use on user generate
     *
     * @param $request
     * @return mixed
     */


    protected function getGenerateUserInformation($request)
    {
        return $request->only(['first_name','last_name','email','password','contact_number','role']);
    }


    /**
     * Get user information
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function getAuthUser()
    {
        if (! $user = JWTAuth::parseToken()->authenticate())
        {
            return response()->json(['user_unauthorized'], 401);
        }
        return response()->json(compact('user'));
    }

    /**
     * Updates user information.
     * @param AuthUserRequest $request
     */

    public function patchAuthUser(AuthUserRequest $request)
    {
        if ($id = $this->getAuthenticatedUserId())
        {
            $data = $this->getUpdateUserInformation($request);
            if ($userId = $this->auth->update($id, $data, true))
            {
                return $this->auth->findById($id);
            }
        }
        return $this->response->errorInternal();
    }

    /**
     * Password update method
     *
     * @param AuthUserPasswordRequest $request
     */

    public function patchAuthUserPassword(AuthUserPasswordRequest $request)
    {
        if ($id = $this->getAuthenticatedUserId())
        {
            $data = $request->only('password');
            $data['password'] = Hash::make($data['password']);
            if ($this->auth->update($id, $data, true))
            {
                return $this->auth->findById($id);
            }
        }
        return $this->response->errorInternal();
    }

    /**
     * User registration - insert credentials for authentication.
     *
     * @param AuthUserRequest $request
     */

    public function postAuthUser(AuthUserRequest $request)
    {
        $credentials = $this->getGenerateUserInformation($request);
        if ($user=$this->auth->create($credentials))
        {
            return response()->json($user);
        }
        return $this->response->errorInternal();
    }


    /**
     * User deletes it's account, also invalidates his token.
     * @return \Illuminate\Http\JsonResponse|void
     *
     */

    public function deleteAuthUser()
    {
        if ($id = $this->getAuthenticatedUserId())
        {
            if ($userId = $this->auth->delete($id))
            {
                JWTAuth::invalidate(JWTAuth::getToken());
                return response()->json("", 200);
            }
        }
        return $this->response->errorInternal();
    }


    /**
     * User login - look for credentials for authentication
     *
     * @param AuthTokenRequest $request
     * @return \Illuminate\Http\JsonResponse|void
     */

    public function getAuthToken(AuthTokenRequest $request)
    {
        if($this->auth->isActive($request->input('email'))) {
            $credentials = $this->getCredentials($request);

            try {
                //attempt to verify credentials and create a token for the user
                if (!$token = JWTAuth::attempt($credentials)) {
                    return $this->response->errorUnauthorized('Incorrect email / password combination');
                }
            } catch (JWTException $e) {
                //something went wrong while attempting to encode the token
                return $this->response->errorInternal();
            }
            return response()->json(compact('token'));
        }
        return $this->response->errorUnauthorized('Inactive user.');

    }

    /**
     * Refresh method
     */

    public function getAuthTokenRefresh()
    {
        //JWTAuth::refresh();
    }

    /**
     * Logout method
     */

    public function getAuthTokenDestroy()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json("", 200);
    }


    /**
     * Get User With Relations
     *
     * @param SellerWithRequest $request
     * @param Repository $config
     * @return mixed
     */
    public function getUserWith(AuthUserWithRequest $request, Config $config)
    {
        $relations = explode(",",$request->input('relations'));
        foreach($relations as $key => $relation)
        {
            if($value = $config->offsetExists('auth-user.model.pivots.auth.'.$relation))
            {
                if(is_array($value))
                {
                    foreach($value as $temp)
                    {
                        $relations[$key] = $temp;
                    }
                }
                $relations[$key] = $config->get('auth-user.model.pivots.auth.'.$relation);
            }
        }
        return response()->json($this->auth->getRelatedCustom($relations,['id' => $this->getAuthenticatedUserId()])[0]);
    }

    /**
     * Token validation method
     *
     * @param AuthTokenValidateRequest $request
     * @param Carbon $carbon
     * @param Config $config
     * @param Connection $conn
     * @return \Dingo\Api\Http\Response|void
     */

    public function postAuthTokenValidate(AuthTokenValidateRequest $request, Carbon $carbon, Config $config, Connection $conn)
    {
        $date = $carbon->now()->subMinutes($config->get('auth.password.expire'));
        // Checking if token exists.

        if(!$conn->table('password_resets')->where('token', $request->input('reset_token'))->exists())
        {
            return $this->response->errorForbidden('Token does not exists.');
        }
        // Checking if token has expired.
        if(!$conn->table('password_resets')->where('token', $request->input('reset_token'))->where('created_at','>=',$date)->exists())
        {
            return $this->response->errorBadRequest('Your password reset token has expired.');
        }
        //everything good, user can reset password (200)
        return $this->response->accepted();
    }

}