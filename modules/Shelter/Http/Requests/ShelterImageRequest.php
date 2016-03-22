<?php namespace Modules\Shelter\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class ShelterImageRequest extends FoundationRequest
{
    public function rules()
    {
        $rules = [
            'avatar' => 'required|image',
            'advert_photo' => 'required|image',
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