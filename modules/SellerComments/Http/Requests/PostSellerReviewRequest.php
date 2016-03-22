<?php namespace Modules\SellerComments\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class PostSellerReviewRequest extends FoundationRequest
{
    public function rules()
    {
        return [
            'review_token' => 'required|exists:seller_enquiry_entities,review_token',
            'rating1' => 'required|numeric',
            'rating2' => 'required|numeric',
            'rating3' => 'required|numeric',
            'rating4' => 'required|numeric',
            'rating5' => 'required|numeric',
            'name' => 'required',
            'suburb_id' => 'required|numeric|exists:location_suburb_entities,id|suburb_state',
            'state_id' => 'required|numeric|exists:location_state_entities,id',
            'about' => 'required',
            'contact_number' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }
}