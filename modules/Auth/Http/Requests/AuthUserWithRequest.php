<?php namespace Modules\Auth\Http\Requests;



use Modules\Foundation\Http\Requests\FoundationRequest;

class AuthUserWithRequest extends FoundationRequest
{
    public function rules()
    {

        $rules = [
            'relations' => 'required|AuthUserRelationExists',
        ];

        return $rules;
    }

    public function authorize()
    {
        return true;
    }


}