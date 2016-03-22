<?php namespace Modules\Seller\Http\Requests;



use Modules\Foundation\Http\Requests\FoundationRequest;

class SellerVerificationProofRequest extends FoundationRequest
{
    public function rules()
    {
        $rules = [
            'proof' => 'required|image',
        ];
        return $rules;
    }

    public function authorize()
    {
        return true;
    }


}