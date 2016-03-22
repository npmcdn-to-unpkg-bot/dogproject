<?php namespace Modules\Dog\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class DogMotherImageRequest extends FoundationRequest
{
    public function rules()
    {
        return [
            'image' => 'required|image',
            'mother_id' => 'required|integer|exists:dog_mother_entities,id',
        ];
    }

    public function authorize()
    {
        return true;
    }


}