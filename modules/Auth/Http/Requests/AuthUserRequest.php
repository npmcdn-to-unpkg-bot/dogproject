<?php namespace Modules\Auth\Http\Requests;



use Illuminate\Http\Request;
use Modules\Foundation\Http\Requests\FoundationRequest;

class AuthUserRequest extends FoundationRequest
{
    public function rules(Request $request)
    {
        switch ($this->httpVerb) {
            case "POST":
                return [
                    'first_name' => 'required|string',
                    'last_name' => 'required|string',
                    'email' => 'required|email|unique:user_account_entities',
                    'password' => 'required|min:6|confirmed',
                    'contact_number' => 'required|numeric',
                    'role' => 'required|numeric|in:1,3',
                ];
                break;
            case "PATCH":
                return [
                    'first_name' => 'string',
                    'last_name' => 'string',
                    'email' => 'email|unique:user_account_entities,id,'.$request->get('id'),
                    'contact_number' => 'string'
                ];
                break;
        }

    }

    public function authorize()
    {
        return true;
    }


}