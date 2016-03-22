<?php namespace Modules\Shelter\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class ShelterEnquiryRequest extends FoundationRequest
{
    public function rules()
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email',
            'enquiry' => 'required|string',
        ];
        return $rules;
    }

    public function authorize()
    {
        return true;
    }


}