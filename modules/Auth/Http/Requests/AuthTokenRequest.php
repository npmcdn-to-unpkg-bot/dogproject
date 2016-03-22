<?php namespace Modules\Auth\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class AuthTokenRequest extends FoundationRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email|exists:user_account_entities',
            'password' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }
}