<?php namespace Modules\Seller\Http\Requests;



use Modules\Foundation\Http\Requests\FoundationRequest;

class SellerVerificationRequest extends FoundationRequest
{
    public function rules()
    {
        $request = $this->instance();
        if($request->route('type') == 'hobby')
        {
            $rules = [
                'question1' => 'required|boolean',
                'question2' => 'required|boolean',
                'question3' => 'required|boolean',
                'question4' => 'required|boolean',
                'question5' => 'required|boolean',
                'question6' => 'required|boolean',
                'question7' => 'required|boolean',
                'question8' => 'required|boolean',
                'question9' => 'required|boolean',
                'question10' => 'required|boolean',
            ];

        }else
        {
            $rules = [
                'type' => 'required|in:1,2',  //biti ce enum nesto,, jos se ne zna što
                'number' => 'required|numeric',
            ];
        }
        return $rules;
    }

    public function authorize()
    {
        return true;
    }


}