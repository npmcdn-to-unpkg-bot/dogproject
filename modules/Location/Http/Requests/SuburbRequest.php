<?php namespace Modules\Location\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class SuburbRequest extends FoundationRequest
{
    public function rules()
    {
        $rules = [
            'state_id' => 'required|integer|exists:location_state_entities,id',
        ];
        return $rules;
    }

    public function authorize()
    {
        return true;
    }


}