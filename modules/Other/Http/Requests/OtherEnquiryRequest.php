<?php namespace Modules\Other\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class OtherEnquiryRequest extends FoundationRequest
{
    public function rules()
    {

        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'contact_number' => 'required',
            'contact_type' => 'required|in:0,1,2',
            'enquiry' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }


}