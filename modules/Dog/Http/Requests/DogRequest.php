<?php namespace Modules\Dog\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class DogRequest extends FoundationRequest
{

    public function rules()
    {
        switch ($this->httpVerb)
        {
            case "POST":

            switch ($this->type_of_listing)
            {
                case "single":
                    return [
                        'breed_id' => 'required|integer|exists:dog_breed_entities,id',
                        'mother_id' => 'required|integer|exists:dog_mother_entities,id',
                        'father_id' => 'required|integer|exists:dog_father_entities,id',
                        'birth_date' => 'required|date',
                        'type_of_listing' => 'required|in:single,mature,litter',
                        'sex' => 'required|in:M,F',
                        'cost' => 'required|numeric',
                        'about' => 'required|string',
                        'vaccination' => 'boolean',
                        'vet_checked' => 'boolean',
                        'desexed' => 'boolean',
                        'de_warmed' => 'boolean',
                        'micro_chipped' => 'boolean',
                        'registration_papers' => 'boolean',
                    ];
                    break;
                case "mature":
                    return [
                        'breed_id' => 'required|integer|exists:dog_breed_entities,id',
                        'mother_id' => 'required|integer|exists:dog_mother_entities,id',
                        'father_id' => 'required|integer|exists:dog_father_entities,id',
                        'birth_date' => 'required|date',
                        'type_of_listing' => 'required|in:single,mature,litter',
                        'sex' => 'required|in:M,F',
                        'cost' => 'required|numeric',
                        'about' => 'required|string',
                        'vaccination' => 'boolean',
                        'vet_checked' => 'boolean',
                        'desexed' => 'boolean',
                        'de_warmed' => 'boolean',
                        'micro_chipped' => 'boolean',
                        'registration_papers' => 'boolean',
                    ];
                    break;
                case "litter":
                    return [
                        'breed_id' => 'required|integer|exists:dog_breed_entities,id',
                        'mother_id' => 'required|integer|exists:dog_mother_entities,id',
                        'father_id' => 'required|integer|exists:dog_father_entities,id',
                        'birth_date' => 'required|date',
                        'type_of_listing' => 'required|in:single,mature,litter',
                        'male_qty' => 'required|integer',
                        'female_qty' => 'required|integer',
                        'cost' => 'required|numeric',
                        'about' => 'required|string',
                        'vaccination' => 'boolean',
                        'vet_checked' => 'boolean',
                        'desexed' => 'boolean',
                        'de_warmed' => 'boolean',
                        'micro_chipped' => 'boolean',
                        'registration_papers' => 'boolean',
                    ];
                    break;

            }
                break;
            case "PUT":
                switch ($this->type_of_listing)
                {
                    case "single":
                        return [
                            'id' => 'required|integer|exists:dog_entities,id',
                            'breed_id' => 'required|integer|exists:dog_breed_entities,id',
                            'mother_id' => 'required|integer|exists:dog_mother_entities,id',
                            'father_id' => 'required|integer|exists:dog_father_entities,id',
                            'birth_date' => 'required|date',
                            'type_of_listing' => 'required|in:single,mature,litter',
                            'sex' => 'required|in:m,f',
                            'cost' => 'required|numeric',
                            'about' => 'required|string',
                            'vaccination' => 'required|boolean',
                            'vet_checked' => 'required|boolean',
                            'desexed' => 'required|boolean',
                            'de_warmed' => 'required|boolean',
                            'micro_chipped' => 'required|boolean',
                            'registration_papers' => 'required|boolean',
                        ];
                        break;
                    case "mature":
                        return [
                            'id' => 'required|integer|exists:dog_entities,id',
                            'breed_id' => 'required|integer|exists:dog_breed_entities,id',
                            'mother_id' => 'required|integer|exists:dog_mother_entities,id',
                            'father_id' => 'required|integer|exists:dog_father_entities,id',
                            'birth_date' => 'required|date',
                            'type_of_listing' => 'required|in:single,mature,litter',
                            'sex' => 'required|in:m,f',
                            'cost' => 'required|numeric',
                            'about' => 'required|string',
                            'vaccination' => 'required|boolean',
                            'vet_checked' => 'required|boolean',
                            'desexed' => 'required|boolean',
                            'de_warmed' => 'required|boolean',
                            'micro_chipped' => 'required|boolean',
                            'registration_papers' => 'required|boolean',
                        ];
                        break;
                    case "litter":
                        return [
                            'id' => 'required|integer|exists:dog_entities,id',
                            'breed_id' => 'required|integer|exists:dog_breed_entities,id',
                            'mother_id' => 'required|integer|exists:dog_mother_entities,id',
                            'father_id' => 'required|integer|exists:dog_father_entities,id',
                            'birth_date' => 'required|date',
                            'type_of_listing' => 'required|in:single,mature,litter',
                            'male_qty' => 'required|integer',
                            'female_qty' => 'required|integer',
                            'cost' => 'required|numeric',
                            'about' => 'required|string',
                            'vaccination' => 'required|boolean',
                            'vet_checked' => 'required|boolean',
                            'desexed' => 'required|boolean',
                            'de_warmed' => 'required|boolean',
                            'micro_chipped' => 'required|boolean',
                            'registration_papers' => 'required|boolean',
                        ];
                        break;

                }
                break;
            case "PATCH":
                switch ($this->type_of_listing)
                {
                    case "single":
                        return [
                            'id' => 'required|integer|exists:dog_entities,id',
                            'breed_id' => 'integer|exists:dog_breed_entities,id',
                            'mother_id' => 'integer|exists:dog_mother_entities,id',
                            'father_id' => 'integer|exists:dog_father_entities,id',
                            'birth_date' => 'date',
                            'type_of_listing' => 'in:single,mature,litter',
                            'sex' => 'in:m,f',
                            'cost' => 'numeric',
                            'about' => 'string',
                            'vaccination' => 'boolean',
                            'vet_checked' => 'boolean',
                            'desexed' => 'boolean',
                            'de_warmed' => 'boolean',
                            'micro_chipped' => 'boolean',
                            'registration_papers' => 'boolean',
                        ];
                        break;
                    case "mature":
                        return [
                            'id' => 'required|integer|exists:dog_entities,id',
                            'breed_id' => 'integer|exists:dog_breed_entities,id',
                            'mother_id' => 'integer|exists:dog_mother_entities,id',
                            'father_id' => 'integer|exists:dog_father_entities,id',
                            'birth_date' => 'date',
                            'type_of_listing' => 'in:single,mature,litter',
                            'sex' => 'in:m,f',
                            'cost' => 'numeric',
                            'about' => 'string',
                            'vaccination' => 'boolean',
                            'vet_checked' => 'boolean',
                            'desexed' => 'boolean',
                            'de_warmed' => 'boolean',
                            'micro_chipped' => 'boolean',
                            'registration_papers' => 'boolean',
                        ];
                        break;
                    case "litter":
                        return [
                            'id' => 'required|integer|exists:dog_entities,id',
                            'breed_id' => 'integer|exists:dog_breed_entities,id',
                            'mother_id' => 'integer|exists:dog_mother_entities,id',
                            'father_id' => 'integer|exists:dog_father_entities,id',
                            'birth_date' => 'date',
                            'type_of_listing' => 'in:single,mature,litter',
                            'male_qty' => 'integer',
                            'female_qty' => 'integer',
                            'cost' => 'numeric',
                            'about' => 'string',
                            'vaccination' => 'boolean',
                            'vet_checked' => 'boolean',
                            'desexed' => 'boolean',
                            'de_warmed' => 'boolean',
                            'micro_chipped' => 'boolean',
                            'registration_papers' => 'boolean',
                        ];
                        break;

                }
                break;

            case "DELETE":

                        return [
                            'id' => 'required|integer|exists:dog_entities,id',
                        ];
                break;

            case "GET":

                $rules = [
                    'in' => 'array',
                    'between' => 'array',
                ];

                return $rules;
                break;

//                $rules = [
//                    'breed_id' => 'required|array',
//                    'type' => 'array',
//                    'sex' => 'array',
//                    'state' => 'in:VIC,NSW,TAS,NT,QLD,SA,WA,ACT',
//                    'price_lower' => 'numeric|between:1,10000',
//                    'price_higher' => 'numeric|between:1,10000',
//                ];
//                $request = $this->instance();
//                if(is_array($request->input('breed_id')))
//                {
//                    foreach ($request->input('breed_id') as $key => $val) {
//                        $rules['breed_id.' . $key] = 'integer|exists:dog_breed_entities,id';
//                    }
//                }
//                if(is_array($request->input('type')))
//                {
//                    foreach ($request->input('type') as $key => $val) {
//                        $rules['type.' . $key] = 'in:puppy,rescue,mature,foster';
//                    }
//                }
//                if(is_array($request->input('sex')))
//                {
//                    foreach ($request->input('sex') as $key => $val) {
//                        $rules['sex.' . $key] = 'in:male,female';
//                    }
//                }
//                if(is_array($request->input('state')))
//                {
//                    foreach ($request->input('state') as $key => $val) {
//                        $rules['state.' . $key] = 'in:VIC,NSW,TAS,NT,QLD,SA,WA,ACT';
//                    }
//                }
//
//                return $rules;
//                break;

        }

    }

    public function authorize()
    {
        return true;
    }


}