<?php namespace Modules\Seller\Http\Requests;



use Modules\Foundation\Http\Requests\FoundationRequest;

class SellerRequest extends FoundationRequest
{
    public function rules()
    {
        switch ($this->httpVerb) {
            case "POST":
                return [
                    'type' => 'required|in:hobby,verified,single',
                    'suburb_id' => 'required|numeric|exists:location_suburb_entities,id|suburb_state',
                    'state_id' => 'required|numeric|exists:location_state_entities,id',
                    'terms' => 'required|boolean',
                ];
                break;
            case "PUT":
                return [
                    'type' => 'in:hobby,verified,single',
                    'suburb_id' => 'required|numeric|exists:location_suburb_entities,id|suburb_state',
                    'state_id' => 'required|numeric|exists:location_state_entities,id',
                    'address' => 'required|string',
                    'about' => 'string'
                ];
                break;
            case "PATCH":
                return [
                    'suburb_id' => 'numeric|exists:location_suburb_entities,id|suburb_state',
                    'state_id' => 'numeric|exists:location_state_entities,id',
                    'address' => 'string',
                    'about' => 'string'
                ];
                break;
        }
    }

    public function authorize()
    {
        return true;
    }


}