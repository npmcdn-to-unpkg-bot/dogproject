<?php namespace Modules\Seller\Http\Requests;



use Modules\Foundation\Http\Requests\FoundationRequest;

class SellerLitterFinalRequest extends FoundationRequest
{
    public function rules()
    {
        return [
            'litter_id' => 'required|numeric|exists:dog_entities,id',
            'sex' => 'required|in:male,female',
        ];
    }

    public function authorize()
    {
        return true;
    }


}