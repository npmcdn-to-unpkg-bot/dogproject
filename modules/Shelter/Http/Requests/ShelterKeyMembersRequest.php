<?php namespace Modules\Shelter\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class ShelterKeyMembersRequest extends FoundationRequest
{
    public function rules()
    {
        switch ($this->httpVerb) {
            case "POST":
                $rules = [
                    'type' => 'required|array',
                    'name' => 'required|array',
                    'email' => 'required|array',
                ];
                $request = $this->instance();
                if(is_array($request->input('type')))
                {
                    foreach ($request->input('type') as $key => $val) {
                        $rules['type.' . $key] = 'integer|in:0,1,2';
                    }
                }
                if(is_array($request->input('name')))
                {
                    foreach ($request->input('name') as $key => $val) {
                        $rules['name.' . $key] = 'string';
                    }
                }
                if(is_array($request->input('email')))
                {
                    foreach ($request->input('email') as $key => $val) {
                        $rules['email.' . $key] = 'email|unique:shelter_key_member_entities,email';
                    }
                }
                return $rules;
                break;
            case "DELETE":
                return [
                    'id' => 'required|integer|exists:shelter_key_member_entities,id',
                ];
                break;
        }



    }

    public function authorize()
    {
        return true;
    }


}