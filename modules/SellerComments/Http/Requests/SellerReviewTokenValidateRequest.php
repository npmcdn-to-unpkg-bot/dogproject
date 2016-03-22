<?php namespace Modules\SellerComments\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class SellerReviewTokenValidateRequest extends FoundationRequest
{
    public function rules()
    {
        return [
            'review_token' => 'required'
        ];
    }

    public function authorize()
    {
        return true;
    }
}