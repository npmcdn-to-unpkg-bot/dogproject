<?php namespace Modules\Dog\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class DogFatherImageRequest extends FoundationRequest
{
    public function rules()
    {
        return [
            'image' => 'required|image',
            'father_id' => 'required|integer|exists:dog_father_entities,id',
        ];
    }

    public function authorize()
    {
        return true;
    }


}