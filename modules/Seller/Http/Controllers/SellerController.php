<?php namespace Modules\Seller\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Config\Repository;
use Illuminate\Database\DatabaseManager;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Association\Repositories\Contracts\AssociationInviteRepositoryInterface;
use Modules\Association\Repositories\Contracts\AssociationMemberRepositoryInterface;
use Modules\Association\Repositories\Entities\AssociationMemberModel;
use Modules\Auth\Repositories\Entities\AuthModel;
use Modules\Dog\Repositories\Contracts\DogRepositoryInterface;
use Modules\Seller\Http\Requests\SellerAssociationRequest;
use Modules\Seller\Http\Requests\SellerDogFinalRequest;
use Modules\Seller\Http\Requests\SellerEnquiryRequest;
use Modules\Seller\Http\Requests\SellerImageRequest;
use Modules\Auth\Repositories\Contracts\AuthRepositoryInterface;
use Modules\Foundation\Http\Controllers\FoundationController;
use Modules\Seller\Http\Requests\SellerJoinAssociationRequest;
use Modules\Seller\Http\Requests\SellerLitterFinalRequest;
use Modules\Seller\Http\Requests\SellerRequest;
use Modules\Seller\Http\Requests\SellerVerificationProofRequest;
use Modules\Seller\Http\Requests\SellerVerificationRequest;
use Modules\Seller\Http\Requests\SellerWithRequest;
use Modules\Seller\Repositories\Contracts\SellerEnquiryRepositoryInterface;
use Modules\Seller\Repositories\Contracts\SellerHobbyVerificationRepositoryInterface;
use Modules\Seller\Repositories\Contracts\SellerRepositoryInterface;
use Intervention\Image\ImageManager as Image;
use Modules\Seller\Repositories\Contracts\SellerVerificationRepositoryInterface;
use Modules\Seller\Repositories\Entities\SellerHobbyVerificationModel;


class SellerController extends FoundationController {
	
	protected $seller;
	protected $sellerEnquiry;
	protected $auth;
	protected $dog;
	protected $associationInvite;
	protected $associationMember;
	protected $sellerVerification;
	protected $sellerHobbyVerification;
	protected $carbon;

    public function __construct(SellerRepositoryInterface $seller, AuthRepositoryInterface $auth, SellerEnquiryRepositoryInterface $sellerEnquiry, AssociationInviteRepositoryInterface $associationInviteRepositoryInterface, AssociationMemberRepositoryInterface $associationMemberRepositoryInterface, SellerVerificationRepositoryInterface $sellerVerificationRepositoryInterface, SellerHobbyVerificationRepositoryInterface $hobbyVerificationRepositoryInterface, DogRepositoryInterface $dog, Carbon $carbon)
    {
        $this->seller = $seller;
        $this->sellerEnquiry = $sellerEnquiry;
        $this->auth = $auth;
        $this->dog = $dog;
        $this->associationInvite = $associationInviteRepositoryInterface;
        $this->associationMember = $associationMemberRepositoryInterface;
        $this->sellerVerification = $sellerVerificationRepositoryInterface;
        $this->sellerHobbyVerification = $hobbyVerificationRepositoryInterface;
        $this->carbon = $carbon;
    }

    /**
     * Specifies what are allowed data keys
     *
     * @param $request
     * @return mixed
     */

    protected function getSellerInformation($request)
    {
        return $request->only(['suburb_id','state_id','address','about','user_id']);
    }

    /**
     * Create seller slug
     *
     * @param $seller
     * @return string
     */

    protected function createSellerSlug($seller)
    {
        $owner = $this->auth->findById($seller);
        do{
            $now = $this->carbon->now();
            $slug = $owner->first_name.'-'.$owner->last_name.'-'.$now->timestamp;
        }while($this->seller->attributeExists(['slug' => $slug ]));
        return $slug;
    }

    /**
     * Creates new seller.
     *
     * @param SellerRequest $request
     * @return \Dingo\Api\Http\Response|void
     */

    public function postSeller(SellerRequest $request)
    {
        if(!$this->seller->attributeExists(['user_id'=> $request->input('user_id')]))
        {
            $data = $this->getSellerInformation($request);
            $data['slug'] = $this->createSellerSlug($data['user_id']);
            if ($this->seller->create($data))
            {
                return $this->response()->created();
            }
            return $this->response->errorInternal();
        }else
        {
            return $this->response->error('Seller with that id already exists.', 403);
        }
    }

    /**
     * Updates seller information, gets id from token, updates all seller information (put).
     *
     * @param SellerRequest $request
     */

    public function putSeller(SellerRequest $request)
    {
        $data = $this->getSellerInformation($request);

        if ($this->seller->findByColumn(['user_id'=>$this->getAuthenticatedUserId()]))
        {
            if($this->seller->update($this->getAuthenticatedUserId(),$data,false))
            {
                return $this->seller->findByColumn(['user_id'=>$this->getAuthenticatedUserId()]);
            }
            return $this->response->errorInternal();
        }
        return $this->response->error('User not found.', 404);
    }

    /**
     * Updates seller information, gets id from token, updates only some of the seller information (patch).
     *
     * @param SellerRequest $request
     */

    public function patchSeller(SellerRequest $request)
    {
        $data = $this->getSellerInformation($request);
        if ($this->seller->findByColumn(['user_id'=>$this->getAuthenticatedUserId()]))
        {
            if($this->seller->update($this->getAuthenticatedUserId(),$data,false))
            {
                return $this->seller->findByColumn(['user_id'=>$this->getAuthenticatedUserId()]);
            }
            return $this->response->errorInternal();
        }
        return $this->response->error('User not found.', 404);
    }

    /**
     * Returns information related to seller model
     *
     * @param SellerWithRequest $request
     * @param Repository $config
     * @return mixed
     */

    public function getSellerWith(SellerWithRequest $request, Repository $config)
    {
        $relations = explode(",",$request->input('relations'));
        foreach($relations as $key => $relation)
        {
            if($value = $config->offsetExists('seller.model.pivots.seller.'.$relation))
            {
                if(is_array($value))
                {
                    foreach($value as $temp)
                    {
                        $relations[$key] = $temp;
                    }
                }
                $relations[$key] = $config->get('seller.model.pivots.seller.'.$relation);
            }
        }
        return $this->seller->getRelatedCustom($relations,['user_id' => $this->getAuthenticatedUserId()]);
    }

    /**
     * User posts enquiry to seller.
     *
     * @param SellerEnquiryRequest $request
     * @return \Dingo\Api\Http\Response|void
     */

    public function postSellerEnquiry(SellerEnquiryRequest $request)
    {
        if ($this->dog->attributeExists(["seller_id" => $request->input('seller_id'), "id" => $request->input('dog_id')]))
        {
            if (!$this->sellerEnquiry->findByColumn(['seller_id' => $request->input('seller_id'), 'dog_id' => $request->input('dog_id'), 'email' => $request->input('email')]))
            {
                if ($this->sellerEnquiry->create($request->except('review_token', 'reviewed')))
                {
                    return $this->response->created();
                }
                return $this->response->errorInternal();
            }
            return $this->response->errorForbidden("Enquiry is allready sent!");
        }
        return $this->response->errorBadRequest('Dog belongs to other seller.');

    }

    /**
     * Creates folder structure for seller uploads.
     *
     * @param Filesystem $folder
     */

    protected function createFolderStructure(Filesystem $folder)
    {
        $this->folder = $folder;
        if(!$this->folder->isDirectory(base_path('public/uploads/seller/') . $this->getAuthenticatedUserId()))
        {
            $this->folder->makeDirectory(base_path('public/uploads/seller/') . $this->getAuthenticatedUserId());
        }
    }

    /**
     * Uploads seller avatar and updates database.
     *
     * @param SellerImageRequest $request
     * @param Image $image
     * @param Filesystem $folder
     */

    public function postSellerImage(SellerImageRequest $request, Image $image, Filesystem $folder)
    {
        $this->image = $image;
        $this->createFolderStructure($folder);
        $avatar = $this->image->make($_FILES['avatar']['tmp_name']);
        $avatar->resize(160,160);
        $avatar->save(base_path('public/uploads/seller/'.$this->getAuthenticatedUserId().'/'.$this->getAuthenticatedUserId().'.jpg'));
        $this->seller->update($this->getAuthenticatedUserId(),['photo' => ('uploads/seller/'.$this->getAuthenticatedUserId().'/'.$this->getAuthenticatedUserId().'.jpg')],false);
    }

    /**
     * Seller accepts association invite.
     *
     * @param SellerAssociationRequest $request
     * @param AssociationMemberModel $associationMemberModel
     * @return \Dingo\Api\Http\Response|void
     */

    public function postSellerAssociation(SellerAssociationRequest $request)
    {
        if($this->associationInvite->attributeExists(['association_id'=>$request->input('association_id'),'seller_id'=>$this->getAuthenticatedUserId()]))
        {
            if(!$this->associationMember->attributeExists(['association_id'=>$request->input('association_id'),'seller_id'=>$this->getAuthenticatedUserId()])) {
                if ($this->associationMember->create(['seller_id' => $this->getAuthenticatedUserId(), 'association_id' => $request->input('association_id')]))
                {
                    $this->associationInvite->findByColumn(['association_id'=>$request->input('association_id'),'seller_id'=>$this->getAuthenticatedUserId()])->update(['status'=>'active']);
                    return $this->response->created();
                }
                return $this->response->errorInternal();
            }
            return $this->response->errorBadRequest("Seller is already part of association.");
        }
        return $this->response->errorBadRequest("Invite wasn't sent to this seller.");
    }

    /**
     * Creates folder for verification proof uploads
     *
     * @param Filesystem $folder
     */

    protected function createVerificationFolder(Filesystem $folder)
    {
        $this->folder = $folder;
        if(!$this->folder->isDirectory(base_path('public/uploads/verification/') . $this->getAuthenticatedUserId()))
        {
            $this->folder->makeDirectory(base_path('public/uploads/verification/') . $this->getAuthenticatedUserId());
        }
    }

    /**
     * Seller sends verification information.
     *
     * @param SellerVerificationRequest $request
     * @param SellerHobbyVerificationModel $sellerHobbyVerificationModel
     * @return \Dingo\Api\Http\Response|void
     */

    public function postSellerVerification(SellerVerificationRequest $request, SellerHobbyVerificationModel $sellerHobbyVerificationModel)
    {
        if($request->route('type') == 'verified')
        {
            if($this->seller->attributeExists(['user_id'=>$this->getAuthenticatedUserId(),'type' => 'verified']))
            {
                if (!$this->sellerVerification->attributeExists(['seller_id' => $this->getAuthenticatedUserId(),'type' => $request->get('type')]))
                {
                    if ($this->sellerVerification->create(['seller_id' => $this->getAuthenticatedUserId(), 'type' => $request->input('type'), 'number' => $request->input('number')])) {
                        return $this->response->created();
                    }
                    return $this->response->errorInternal();
                }
                return $this->response->errorBadRequest("Seller already submitted verification information.");
            }
            return $this->response->errorBadRequest("Seller is not verified breeder.");
        }elseif ($request->route('type') == 'hobby')
        {
            if($this->seller->attributeExists(['user_id'=>$this->getAuthenticatedUserId(),'type' => 'hobby']))
            {
                if (!$this->sellerHobbyVerification->attributeExists(['seller_id' => $this->getAuthenticatedUserId()]))
                {
                    if ($sellerHobbyVerificationModel->create(['seller_id' => $this->getAuthenticatedUserId(),'question1' => $request->input('question1'),'question2' => $request->input('question2'),'question3' => $request->input('question3'),'question4' => $request->input('question4'),'question5' => $request->input('question5'),'question6' => $request->input('question6'),'question7' => $request->input('question7'),'question8' => $request->input('question8'),'question9' => $request->input('question9'),'question10' => $request->input('question10')]))
                    {
                        return $this->response->created();
                    }
                    return $this->response->errorInternal();
                }
                return $this->response->errorBadRequest("Seller already submitted verification information.");
            }
            return $this->response->errorUnauthorized("Seller is not a hobby breeder.");
        }
        return $this->response->errorBadRequest("Seller not found or does not need verification.");
    }

    /**
     * Upload verification proof
     *
     * @param SellerVerificationProofRequest $request
     * @param Filesystem $folder
     * @param Image $image
     */

    public function postSellerVerificationProof(SellerVerificationProofRequest $request, Filesystem $folder, Image $image)
    {
        $this->createVerificationFolder($folder);
        $this->image = $image;
        $proof = $this->image->make($_FILES['proof']['tmp_name']);
        $proof->save(base_path('public/uploads/verification/'.$this->getAuthenticatedUserId()).'/'.$this->getAuthenticatedUserId().'.jpg');
    }

    /**
     * User gets verification information and status
     *
     * @param Request $request
     */

    public function getSellerVerification(Request $request)
    {
        if($request->route('type') == 'verified')
        {
            if ($this->sellerVerification->attributeExists(['seller_id' => $this->getAuthenticatedUserId()])) {
                return $this->sellerVerification->findByColumn(['seller_id' => $this->getAuthenticatedUserId()]);
            }
            return $this->response->errorBadRequest("Seller didn't send verification information.");
        }elseif ($request->route('type') == 'hobby')
        {
            if ($this->sellerHobbyVerification->attributeExists(['seller_id' => $this->getAuthenticatedUserId()])) {
                return $this->sellerHobbyVerification->findByColumn(['seller_id' => $this->getAuthenticatedUserId()]);
            }
            return $this->response->errorBadRequest("Seller didn't send verification information.");
        }
    }

    /**
     * Seller sends request to join association
     *
     * @param SellerJoinAssociationRequest $request
     * @return \Dingo\Api\Http\Response|void
     */

    public function postSellerJoinAssociation(SellerJoinAssociationRequest $request)
    {
        if(!$this->associationInvite->attributeExists(['seller_id' => $this->getAuthenticatedUserId(), 'association_id' => $request->input('association_id') ]))
        {
            $email = $this->auth->findByColumn(['id'=> $this->getAuthenticatedUserId()],['email']);
            $suburb_state = $this->seller->findByColumn(['user_id'=> $this->getAuthenticatedUserId()],['state_id','suburb_id']);
            if ($this->associationInvite->create(['association_id' => $request->input('association_id'),'seller_id' => $this->getAuthenticatedUserId(),'member_email' => $email['email'],'state_id' => $suburb_state['state_id'],'suburb_id' => $suburb_state['suburb_id'],'requested'=>'seller', 'number' => $request->input('number')]))
            {
                return $this->response->created();
            }
            return $this->response->errorInternal();
        }
        return $this->response->errorBadRequest("Seller is already in process for joining.");
    }

    /**
     * Method for selling a dog
     *
     * @param SellerDogFinalRequest $request
     * @return \Illuminate\Http\JsonResponse|void
     */

    public function patchSellerDogFinal(SellerDogFinalRequest $request)
    {
        if ($this->dog->attributeExists(["seller_id" => $this->getAuthenticatedUserId(), "id" => $request->input('dog_id')]))
        {
            $listing = $this->dog->findByColumn(["seller_id" => $this->getAuthenticatedUserId(), "id" => $request->input('dog_id')],['type_of_listing']);
            if ($listing['type_of_listing'] != 'litter')
            {
                if ($this->dog->update($request->input('dog_id'), ['sold' => 1], true))
                {
                    return $this->dog->findByColumn(['id'=>$request->input('dog_id')]);
                }
                return $this->response->errorInternal();
            }
            return $this->response->errorBadRequest('Wrong dog type.');
        }
        return $this->response->errorBadRequest('Dog belongs to other seller.');
    }

    /**
     * Method for selling a dog from litter.
     *
     * @param SellerLitterFinalRequest $request
     * @param DatabaseManager $db
     * @return \Illuminate\Http\JsonResponse|void
     */

    public function patchSellerLitterFinal(SellerLitterFinalRequest $request,DatabaseManager $db)
    {
        if ($this->dog->attributeExists(["seller_id" => $this->getAuthenticatedUserId(), "id" => $request->input('litter_id')]))
        {
            $listing = $this->dog->findByColumn(["seller_id" => $this->getAuthenticatedUserId(), "id" => $request->input('litter_id')],['type_of_listing']);
            if ($listing['type_of_listing'] == 'litter')
            {
                if($request->input('sex') == 'male')
                {
                    if($db->connection()->getPdo()->exec('UPDATE dog_entities SET male_qty = male_qty - 1, male_sold = male_sold + 1  WHERE id = '.$request->input('litter_id').' AND male_qty > 0'))
                    {
                        return $this->dog->findByColumn(['id'=>$request->input('litter_id')]);
                    }
                    return $this->response->errorBadRequest('Dog not available.');
                }elseif($request->input('sex') == 'female')
                {
                    if($db->connection()->getPdo()->exec('UPDATE dog_entities SET female_qty = female_qty - 1, female_sold = female_sold + 1  WHERE id = '.$request->input('litter_id').' AND female_qty > 0'))
                    {
                        return $this->dog->findByColumn(['id'=>$request->input('litter_id')]);
                    }
                    return $this->response->errorBadRequest('Dog not available.');
                }
            }
            return $this->response->errorBadRequest('Wrong dog type.');
        }
        return $this->response->errorBadRequest('Dog belongs to other seller.');
    }

    /**
     * Search sellers by slug and return related information
     *
     * @param Request $request
     */

    public function getSellerSlug(Request $request)
    {
        if($this->seller->findByColumn(['slug'=>$request->route('slug')]))
        {
            return $this->seller->getRelatedCustom(['users','suburb','state','verification','verification_hobby','review.suburb','review.state','dogs.breed','dogs.mother.breed','dogs.father.breed'],['slug'=>$request->route('slug')]);
        }
        return $this->response->errorNotFound('Slug not found.');
    }


}