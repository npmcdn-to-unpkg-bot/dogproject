<?php namespace Modules\Shelter\Http\Requests;



use Modules\Foundation\Http\Requests\FoundationRequest;

class ShelterRequest extends FoundationRequest
{
    public function rules()
    {
        switch ($this->httpVerb) {
            case "POST":
                return [
                    'name' => 'required|string',
                    'web_address' => 'required|string',
                    'address' => 'required|string',
                    'suburb_id' => 'required|numeric|exists:location_suburb_entities,id|suburb_state',
                    'state_id' => 'required|numeric|exists:location_state_entities,id',
                    'facebook' => 'required|string',
                    'twitter' => 'required|string',
                    'instagram' => 'required|string',
                    'about' => 'required|string',
                    'newsletter' => 'required|boolean',
                    'terms' => 'required|boolean'
                ];
                break;
            case "PUT":
                return [
                    'name' => 'required|string',
                    'web_address' => 'required|string',
                    'address' => 'required|string',
                    'suburb_id' => 'required|numeric|exists:location_suburb_entities,id|suburb_state',
                    'state_id' => 'required|numeric|exists:location_state_entities,id',
                    'facebook' => 'required|string',
                    'twitter' => 'required|string',
                    'instagram' => 'required|string',
                    'about' => 'required|string',
                    'newsletter' => 'required|boolean'
                ];
                break;
            case "PATCH":
                return [
                    'name' => 'string',
                    'web_address' => 'string',
                    'address' => 'string',
                    'suburb_id' => 'numeric|exists:location_suburb_entities,id|suburb_state',
                    'state_id' => 'numeric|exists:location_state_entities,id',
                    'facebook' => 'string',
                    'twitter' => 'string',
                    'instagram' => 'string',
                    'about' => 'string',
                    'newsletter' => 'boolean'
                ];
                break;
        }
    }

    public function authorize()
    {
        return true;
    }


}