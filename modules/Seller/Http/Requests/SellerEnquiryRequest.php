<?php namespace Modules\Seller\Http\Requests;



use Modules\Foundation\Http\Requests\FoundationRequest;

class SellerEnquiryRequest extends FoundationRequest
{
    public function rules()
    {
        return [
            'seller_id' => 'required|numeric|exists:seller_account_entities,user_id',
            'dog_id' => 'required|numeric|exists:dog_entities,id',
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