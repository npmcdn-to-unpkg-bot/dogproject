<?php namespace Modules\ShelterComments\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class PostShelterReviewRequest extends FoundationRequest
{
    public function rules()
    {
        return [
            'shelter_review_token' => 'required|exists:shelter_dog_enquiry_entities,review_token',
            'rating1' => 'required|integer|in:1,2,3,4,5',
            'rating2' => 'required|integer|in:1,2,3,4,5',
            'rating3' => 'required|integer|in:1,2,3,4,5',
            'rating4' => 'required|integer|in:1,2,3,4,5',
            'rating5' => 'required|integer|in:1,2,3,4,5',
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