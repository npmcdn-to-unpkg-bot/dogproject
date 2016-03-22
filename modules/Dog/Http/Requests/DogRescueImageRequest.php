<?php namespace Modules\Dog\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class DogRescueImageRequest extends FoundationRequest
{
    public function rules()
    {
        $rules = [
            'id' => 'required|integer|exists:dog_entities,id',
            'images' => 'required|array',
        ];
        $request = $this->instance();
        if(is_array($request->input('images')))
        {
            foreach ($request->input('images') as $key => $val) {
                $rules['images.' . $key] = 'image';
            }
        }
        return $rules;
    }

    public function authorize()
    {
        return true;
    }


}