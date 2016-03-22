<?php namespace Modules\Seller\Http\Requests;



use Modules\Foundation\Http\Requests\FoundationRequest;

class SellerAssociationRequest extends FoundationRequest
{
    public function rules()
    {
        return [
            'association_id' => 'required|integer|exists:association_entities,user_id',
        ];
    }

    public function authorize()
    {
        return true;
    }


}