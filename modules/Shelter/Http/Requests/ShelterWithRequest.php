<?php namespace Modules\Shelter\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class ShelterWithRequest extends FoundationRequest
{
    public function rules()
    {
        $rules = [
            'relations' => 'required|ShelterRelationExists',
        ];
        return $rules;
    }

    public function authorize()
    {
        return true;
    }


}