<?php namespace Modules\Seller\Http\Requests;



use Modules\Foundation\Http\Requests\FoundationRequest;

class SellerDogFinalRequest extends FoundationRequest
{
    public function rules()
    {
        return [
            'dog_id' => 'required|numeric|exists:dog_entities,id',
        ];
    }

    public function authorize()
    {
        return true;
    }


}