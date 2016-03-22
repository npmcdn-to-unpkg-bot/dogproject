<?php //
namespace Modules\Association\Http\Requests;



use Modules\Foundation\Http\Requests\FoundationRequest;

class AssociationRequest extends FoundationRequest
{
    public function rules()
    {
        switch ($this->httpVerb) {
            case "POST":
                return [
                    'name' => 'required|string',
                    'first_name' => 'required|string',
                    'last_name' => 'required|string',
                    'email' => 'required|email|unique:association_request_entities,email',
                    'contact_number' => 'required|string',
                    'website' => 'required|string',
                    'suburb_id' => 'required|numeric|exists:location_suburb_entities,id|suburb_state',
                    'state_id' => 'required|numeric|exists:location_state_entities,id',
                ];
                break;
            case "PUT":
                return [
                    'name' => 'required|string',
                    'suburb_id' => 'required|numeric|exists:location_suburb_entities,id',
                    'state_id' => 'required|numeric|exists:location_state_entities,id',
                    'breed' => 'required|integer|exists:dog_breed_entities,id',
                    'about' => 'required|string',
                ];
                break;
            case "PATCH":
                return [
                    'name' => 'string',
                    'suburb_id' => 'required|numeric|exists:location_suburb_entities,id',
                    'state_id' => 'required|numeric|exists:location_state_entities,id',
                    'breed' => 'integer|exists:dog_breed_entities,id',
                    'about' => 'string',
                ];
                break;

        }
    }

    public function authorize()
    {
        return true;
    }


}