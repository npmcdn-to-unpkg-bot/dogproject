<?php namespace Modules\Sheltercomments\Http\Controllers;

use Modules\Foundation\Http\Controllers\FoundationController;
use Illuminate\Mail\Mailer as Mail;
use Modules\Other\MailerTrait;
use Modules\Shelter\Repositories\Contracts\ShelterEnquiryRepositoryInterface;
use Modules\ShelterComments\Http\Requests\PostShelterReviewRequest;
use Modules\ShelterComments\Http\Requests\ShelterReviewRequest;
use Modules\ShelterComments\Http\Requests\ShelterReviewTokenValidateRequest;
use Modules\ShelterComments\Repositories\Contracts\ShelterReviewRepositoryInterface;

class ShelterCommentsController extends FoundationController {
	
	protected $shelterEnquiry;
	protected $shelterReview;
    use MailerTrait;

    public function __construct(ShelterEnquiryRepositoryInterface $shelterEnquiry, ShelterReviewRepositoryInterface $shelterReview)
	{
		$this->shelterEnquiry = $shelterEnquiry;
		$this->shelterReview = $shelterReview;
	}


    /**
     * Shelter request review from user. Needs to enter users email address. Address is validated and if everything is
     * OK, review token is generated.
     *
     * @param ShelterReviewRequest $request
     * @param Mail $mailer
     * @return \Dingo\Api\Http\Response|void
     */

    public function postShelterReviewRequest(ShelterReviewRequest $request, Mail $mailer)
    {
        foreach($request->input('email') as $email)
        {
            if(!$this->shelterEnquiry->findByColumn(['shelter_id' => $this->getAuthenticatedUserId(),'email' => $email]))
            {
                return $this->response()->errorForbidden("Shelter doesn't have enquiries for given email.".$email);
            }
            if (!$this->shelterEnquiry->findByColumn(['shelter_id' => $this->getAuthenticatedUserId(), 'email' => $email, 'review_token' => '']))
            {
                return $this->response()->errorForbidden("Review already requested for given email.".$email);
            }
            // finding model by repository method and updating it with model method
            $review_token = str_random(64);
            $this->shelterEnquiry->findByColumn(['email' => $email])->update(['review_token' => $review_token]);
            $data['email'] = $email;
            $data['name'] = 'Petagree support';
            $data['to'] = $email;
            $data['subject'] = 'Review';
            $data['review_token'] = $review_token;
            $this->mailSend($mailer,'review',$data);
        }
        return $this->response()->created();

    }


    /**
     * Validating review token, checking if exists in table and checking if review is already written.
     *
     * @param ShelterReviewTokenValidateRequest $request
     */


    public function postShelterReviewTokenValidate(ShelterReviewTokenValidateRequest $request)
    {
        if(!$this->shelterEnquiry->attributeExists(["review_token"=>$request->input('review_token')]))
        {
            return $this->response()->errorForbidden("Token does not exists.");
        }
        if(!$this->shelterEnquiry->attributeExists(["review_token"=>$request->input('review_token'),"reviewed"=>0]))
        {
            return $this->response()->errorForbidden("Review is already written.");
        }
        return $this->response->array("")->setStatusCode(200);
    }

    /**
     * Adding shelter review and comment in table, if validations are okay.
     *
     * @param PostShelterReviewRequest $request
     * @return \Dingo\Api\Http\Response|void
     */

    public function postShelterReview(PostShelterReviewRequest $request)
    {
            $user = $this->shelterEnquiry->findByColumn(['review_token' => $request->input('shelter_review_token')]);
            $data = $request->except('approved');
            $data['shelter_id'] = $user->shelter_id;
            if ($this->shelterReview->create($data))
            {
                $this->shelterEnquiry->findByColumn(['review_token' => $request->input('shelter_review_token')])->update(['reviewed' => 1]);
                return $this->response()->created();
            }
            return $this->response()->errorInternal();
    }
	
}