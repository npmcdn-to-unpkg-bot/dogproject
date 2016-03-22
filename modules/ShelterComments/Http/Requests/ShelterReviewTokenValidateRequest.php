<?php namespace Modules\ShelterComments\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class ShelterReviewTokenValidateRequest extends FoundationRequest
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