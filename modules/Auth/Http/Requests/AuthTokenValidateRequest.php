<?php namespace Modules\Auth\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class AuthTokenValidateRequest extends FoundationRequest
{
    public function rules()
    {
        return [
            'reset_token' => 'required'
        ];
    }

    public function authorize()
    {
        return true;
    }
}