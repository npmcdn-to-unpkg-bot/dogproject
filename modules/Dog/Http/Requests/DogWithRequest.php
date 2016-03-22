<?php namespace Modules\Dog\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class DogWithRequest extends FoundationRequest
{
    public function rules()
    {
        $rules = [
            'relations' => 'required|DogRelationExists',
        ];
        return $rules;
    }

    public function authorize()
    {
        return true;
    }


}