<?php namespace Modules\ShelterComments\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class ShelterReviewRequest extends FoundationRequest
{
    public function rules()
    {

        $rules = [
            'email' => 'required|array',
        ];

        $request = $this->instance();
        if($request->has('email') && is_array($request->input('email')))
        {
            foreach ($request->input('email') as $key => $val)
            {
                $rules['email.' . $key] = 'email|exists:shelter_dog_enquiry_entities,email';
            }
        }
        return $rules;
    }

    public function authorize()
    {
        return true;
    }
}