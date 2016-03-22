<?php namespace Modules\Association\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class AssociationWithRequest extends FoundationRequest
{
    public function rules()
    {
        $rules = [
            'relations' => 'required|AssociationRelationExists',
        ];
        return $rules;
    }

    public function authorize()
    {
        return true;
    }


}