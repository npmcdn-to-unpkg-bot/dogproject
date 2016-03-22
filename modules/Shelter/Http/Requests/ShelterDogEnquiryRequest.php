<?php namespace Modules\Shelter\Http\Requests;



use Modules\Foundation\Http\Requests\FoundationRequest;

class ShelterDogEnquiryRequest extends FoundationRequest
{
    public function rules()
    {
        return [
            'shelter_id' => 'required|numeric|exists:shelter_entities,user_id',
            'dog_id' => 'required|numeric|exists:dog_rescue_entities,id',
            'name' => 'required|string',
            'email' => 'required|email',
            'contact_number' => 'required|string',
            'enquiry' => 'required|string'
        ];
    }

    public function authorize()
    {
        return true;
    }


}