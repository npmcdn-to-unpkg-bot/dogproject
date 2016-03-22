<?php namespace Modules\Seller\Http\Requests;



use Modules\Foundation\Http\Requests\FoundationRequest;

class SellerWithRequest extends FoundationRequest
{
    public function rules()
    {

        $rules = [
            'relations' => 'required|SellerRelationExists',
        ];

        return $rules;
    }

    public function authorize()
    {
        return true;
    }


}