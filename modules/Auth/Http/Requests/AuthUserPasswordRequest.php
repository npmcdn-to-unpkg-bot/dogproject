<?php namespace Modules\Auth\Http\Requests;



use Modules\Foundation\Http\Requests\FoundationRequest;

class AuthUserPasswordRequest extends FoundationRequest
{
    public function rules()
    {
        return [
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function authorize()
    {
        return true;
    }


}