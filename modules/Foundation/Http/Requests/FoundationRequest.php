<?php namespace Modules\Foundation\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class FoundationRequest extends FormRequest
{
    protected $httpVerb;

    protected $type_of_listing;

    public function response(array $errors)
    {

        if ($this->ajax() || $this->wantsJson() || env('APP_ENV') == 'local')
        {
            throw new StoreResourceFailedException('Unprocessable Entity.', $errors);
        }

        return $this->redirector->to($this->getRedirectUrl())
            ->withInput($this->except($this->dontFlash))
            ->withErrors($errors, $this->errorBag);
    }

    /**
     * Extending validator instance class, adding sometimes method.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function getValidatorInstance()
    {
        $request = $this->instance();
        $this->httpVerb = $request->method();
        if($request->input('type_of_listing'))
        {
            $this->type_of_listing = $request->input('type_of_listing');
        }
        $validator = parent::getValidatorInstance();
        $validator->sometimes('token', 'tokenExpired', function($input)
        {
            return DB::table('password_resets')->where('token', $input->token)->exists();
        });

        $validator->sometimes('review_token', 'reviewed', function($input)
        {
            return DB::table('seller_enquiry_entities')->where('review_token', $input->review_token)->exists();
        });

        $validator->sometimes('shelter_review_token', 'shelter_reviewed', function($input)
        {
            return DB::table('shelter_dog_enquiry_entities')->where('review_token', $input->shelter_review_token)->exists();
        });


        $validator->sometimes('member_email', 'verifiedBreeder', function($input)
        {
            return DB::table('user_account_entities')->where('email', $input->member_email)->exists();
        });

        $validator->sometimes('suburb_id', 'suburb_state', function($input)
        {
            return DB::table('location_suburb_entities')->where('id', $input->suburb_id)->exists();
        });

        return $validator;
    }


}