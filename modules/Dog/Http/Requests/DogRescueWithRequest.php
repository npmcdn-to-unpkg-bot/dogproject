<?php namespace Modules\Dog\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class DogRescueWithRequest extends FoundationRequest
{
    public function rules()
    {
        $rules = [
            'relations' => 'required|DogRescueRelationExists',
        ];
        return $rules;
    }

    public function authorize()
    {
        return true;
    }


}