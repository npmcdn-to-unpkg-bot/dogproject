<?php namespace Modules\Association\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class AssociationEnquiryRequest extends FoundationRequest
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