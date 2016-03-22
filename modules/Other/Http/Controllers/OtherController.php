<?php namespace Modules\Other\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Mail\Mailer as Mail;
use Modules\Foundation\Http\Controllers\FoundationController;
use Modules\Other\Http\Requests\OtherEnquiryRequest;
use Modules\Other\MailerTrait;
use Modules\Other\Repositories\Contracts\ContactRepositoryInterface;

class OtherController extends FoundationController {

    use MailerTrait;
	
	protected $contact;
    protected $name;
    protected $sender_email;
    protected $contact_number;
    protected $type;
    protected $enquiry;


    public function __construct(ContactRepositoryInterface $contact)
	{
		$this->contact = $contact;
	}

    /**
     * Sends user enquiry to petagree
     *
     * @param Mail $mailer
     * @param OtherEnquiryRequest $request
     * @return \Dingo\Api\Http\Response|void
     */

    public function postOtherEnquiry(Mail $mailer, OtherEnquiryRequest $request)
    {
        if ($this->contact->create($request->input()))
        {
            $request->merge(['to'=>'aglavas11@gmail.com','subject'=>'Enquiry']); //mail koji se šalje petagree supportu
            $this->mailSend($mailer,'enquiry',$request->input());
            return $this->response->created();
        }
        return $this->response->errorInternal();
    }

    public function getDogBreed()
    {
        return response()->json(DB::table('dog_breed_entities')->get());
    }
}