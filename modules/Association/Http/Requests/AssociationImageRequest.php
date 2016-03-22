<?php namespace Modules\Association\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class AssociationImageRequest extends FoundationRequest
{
    public function rules()
    {
        $rules = [
            'avatar' => 'required|image',
            'banner' => 'required|image',
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