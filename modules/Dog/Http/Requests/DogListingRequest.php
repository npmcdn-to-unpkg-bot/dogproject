<?php namespace Modules\Dog\Http\Requests;

use Modules\Foundation\Http\Requests\FoundationRequest;

class DogListingRequest extends FoundationRequest
{
    public function rules()
    {
        return [
            'type_of_listing' => 'required|in:single,mature,litter',
        ];
    }

    public function authorize()
    {
        return true;
    }


}