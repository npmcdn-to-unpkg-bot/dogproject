<?php namespace Modules\Auth\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class AuthUserResetPasswordRequest extends FoundationRequest
{
    public function rules()
    {
        switch ($this->httpVerb) {
            case "POST":
                return [
                    'email' => 'required|email'
                ];
                break;
            case "PATCH":
                return [
                    'token' => 'required|exists:password_resets,token',
                    'password' => 'required|confirmed|min:6',
                ];
                break;
        }
    }

    public function authorize()
    {
        return true;
    }
}