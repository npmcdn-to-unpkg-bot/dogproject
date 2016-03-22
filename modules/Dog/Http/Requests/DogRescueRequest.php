<?php namespace Modules\Dog\Http\Requests;


use Modules\Foundation\Http\Requests\FoundationRequest;

class DogRescueRequest extends FoundationRequest
{
    public function rules()
    {
        switch ($this->httpVerb) {
            case "POST":
                return [
                    'breed_id' => 'required|integer|exists:dog_breed_entities,id',
                    'name' => 'required|string',
                    'birth_date' => 'required|date',
                    'sex' => 'required|in:m,f',
                    'cost' => 'required|numeric',
                    'about' => 'required|string',
                    'vaccination' => 'required|boolean',
                    'vet_checked' => 'required|boolean',
                    'desexed' => 'required|boolean',
                    'de_warmed' => 'required|boolean',
                    'micro_chipped' => 'required|boolean',
                    'registration_papers' => 'required|boolean',
                    'family_dog' => 'required|boolean',
                    'indoor_dog' => 'required|boolean',
                    'energetic' => 'required|boolean',
                    'friendly' => 'required|boolean',
                    'outdoor_dog' => 'required|boolean',
                    'relaxed' => 'required|boolean',
                ];
                break;
            case "PUT":
                return [
                    'id' => 'required|integer|exists:dog_entities,id',
                    'breed_id' => 'required|integer|exists:dog_breed_entities,id',
                    'name' => 'required|string',
                    'birth_date' => 'required|date',
                    'sex' => 'required|in:m,f',
                    'cost' => 'required|numeric',
                    'about' => 'required|string',
                    'vaccination' => 'required|boolean',
                    'vet_checked' => 'required|boolean',
                    'desexed' => 'required|boolean',
                    'de_warmed' => 'required|boolean',
                    'micro_chipped' => 'required|boolean',
                    'registration_papers' => 'required|boolean',
                    'family_dog' => 'required|boolean',
                    'indoor_dog' => 'required|boolean',
                    'energetic' => 'required|boolean',
                    'friendly' => 'required|boolean',
                    'outdoor_dog' => 'required|boolean',
                    'relaxed' => 'required|boolean',
                ];
                break;
            case "PATCH":
                return [
                    'id' => 'integer|exists:dog_entities,id',
                    'breed_id' => 'integer|exists:dog_breed_entities,id',
                    'name' => 'string',
                    'birth_date' => 'date',
                    'sex' => 'in:m,f',
                    'cost' => 'numeric',
                    'about' => 'string',
                    'vaccination' => 'boolean',
                    'vet_checked' => 'boolean',
                    'desexed' => 'boolean',
                    'de_warmed' => 'boolean',
                    'micro_chipped' => 'boolean',
                    'registration_papers' => 'boolean',
                    'family_dog' => 'boolean',
                    'indoor_dog' => 'boolean',
                    'energetic' => 'boolean',
                    'friendly' => 'boolean',
                    'outdoor_dog' => 'boolean',
                    'relaxed' => 'boolean',
                ];
                break;
            case "DELETE":
                return [
                    'id' => 'required|integer|exists:dog_entities,id'
                ];
                break;
        }
    }

    public function authorize()
    {
        return true;
    }


}