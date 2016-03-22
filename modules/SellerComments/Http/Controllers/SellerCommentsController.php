<?php namespace Modules\SellerComments\Http\Controllers;

use Illuminate\Config\Repository;
use Modules\Dog\Repositories\Contracts\DogRepositoryInterface;
use Modules\Foundation\Http\Controllers\FoundationController;
use Modules\Other\MailerTrait;
use Modules\Seller\Repositories\Contracts\SellerEnquiryRepositoryInterface;
use Modules\SellerComments\Http\Requests\PostSellerReviewRequest;
use Modules\SellerComments\Http\Requests\SellerReviewRequest;
use Modules\SellerComments\Http\Requests\SellerReviewTokenValidateRequest;
use Modules\SellerComments\Repositories\Contracts\SellerCommentsRepositoryInterface;
use Illuminate\Mail\Mailer as Mail;

class SellerCommentsController extends FoundationController {


    use MailerTrait;
    protected $review;

    protected $enquiry;

    protected $dog;

    public function __construct(SellerCommentsRepositoryInterface $review, SellerEnquiryRepositoryInterface $enquiry,DogRepositoryInterface $dog)
    {
        $this->review = $review;
        $this->enquiry = $enquiry;
        $this->dog = $dog;
    }

    /**
     * Seller request review from user. Needs to enter users email address. Address is validated and if everything is
     * OK, review token is generated.
     *
     * @param SellerReviewRequest $request
     * @param Mail $mailer
     * @param Repository $config
     * @return \Dingo\Api\Http\Response|void
     */

	public function postSellerReviewRequest(SellerReviewRequest $request, Mail $mailer)
	{
        foreach($request->input('email') as $email)
        {
            if(!$this->enquiry->findByColumn(['seller_id' => $this->getAuthenticatedUserId(),'email' => $email]))
            {
                return $this->response()->errorForbidden("You don't have enquiries for given email: ".$email);
            }
            if (!$this->enquiry->findByColumn(['seller_id' => $this->getAuthenticatedUserId(), 'email' => $email, 'review_token' => '']))
            {
                return $this->response()->errorForbidden("Review already requested for given email: ".$email);
            }
            // finding model by repository method and updating it with model method
            $review_token = str_random(64);
            $this->enquiry->findByColumn(['email' => $email])->update(['review_token' => $review_token]);
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
     * @param SellerReviewTokenValidateRequest $request
     */


    public function postSellerReviewTokenValidate(SellerReviewTokenValidateRequest $request)
    {
        if(!$this->enquiry->attributeExists(["review_token"=>$request->input('review_token')]))
        {
            return $this->response()->errorBadRequest("Token does not exists.");
        }
        if(!$this->enquiry->attributeExists(["review_token"=>$request->input('review_token'),"reviewed"=>0]))
        {
            return $this->response()->errorBadRequest("Review is already written.");
        }
        return $this->response->array($this->enquiry->findByColumn(["review_token"=>$request->input('review_token')])->toArray())->setStatusCode(200);
    }

    /**
     * Adding sellers review and comment in table, if validations are okay.
     *
     * @param PostSellerReviewRequest $request
     * @return \Dingo\Api\Http\Response|void
     */

    public function postSellerReview(PostSellerReviewRequest $request)
    {
        $user = $this->enquiry->findByColumn(['review_token'=>$request->input('review_token')]);
        $data = $request->except('approved');
        $data['user_id'] = $user->seller_id;
        if($this->review->create($data))
        {
            $this->enquiry->findByColumn(['review_token'=>$request->input('review_token')])->update(['reviewed'=>1]);
            return $this->response()->created();
        }
        return $this->response()->errorInternal();
    }
	
}