<?php namespace Modules\Dog\Http\Requests;


use Modules\Foundation\Http\Requests\FoundationRequest;

class DogMotherRequest extends FoundationRequest
{
    public function rules()
    {
        switch ($this->httpVerb) {
            case "POST":
                return [
                    'breed_id' => 'required|integer|exists:dog_breed_entities,id',
                    'name' => 'required|string',
                    'birth_date' => 'required|date',
                    'temperament' => 'required|integer|in:1,2,3',
                    'energy' => 'required|integer|in:1,2,3',
                    'intelligence' => 'required|integer|in:1,2,3',
                    'maintenance' => 'required|integer|in:1,2,3',
                ];
                break;
            case "DELETE":
                return [
                    'id' => 'required|integer|exists:dog_mother_entities,id'
                ];
                break;
        }
    }

    public function authorize()
    {
        return true;
    }


}