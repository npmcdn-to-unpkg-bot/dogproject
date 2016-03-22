<?php namespace Modules\Seller\Http\Requests;



use Modules\Foundation\Http\Requests\FoundationRequest;

class SellerImageRequest extends FoundationRequest
{
    public function rules()
    {
        return [
            'avatar' => 'required|image',
        ];
    }

    public function authorize()
    {
        return true;
    }


}