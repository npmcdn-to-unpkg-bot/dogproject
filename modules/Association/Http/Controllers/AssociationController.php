<?php namespace Modules\Association\Http\Controllers;

use Illuminate\Config\Repository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Modules\Association\Http\Requests\AssociationEnquiryRequest;
use Modules\Association\Http\Requests\AssociationImageRequest;
use Modules\Association\Http\Requests\AssociationKeyMembersRequest;
use Modules\Association\Http\Requests\AssociationMemberRequest;
use Modules\Association\Http\Requests\AssociationRequest;
use Modules\Association\Http\Requests\AssociationWithRequest;
use Modules\Association\Repositories\Contracts\AssociationInviteRepositoryInterface;
use Modules\Association\Repositories\Contracts\AssociationKeyMemberRepositoryInterface;
use Modules\Association\Repositories\Contracts\AssociationRepositoryInterface;
use Modules\Association\Repositories\Contracts\UserAssociationRepositoryInterface;
use Modules\Association\Repositories\Entities\AssociationEnquiryModel;
use Modules\Association\Repositories\Entities\AssociationKeyMemberModel;
use Modules\Association\Repositories\Entities\AssociationRequestModel;
use Modules\Association\Repositories\Entities\StaffPickAssociationModel;
use Modules\Auth\Repositories\Contracts\AuthRepositoryInterface;
use Modules\Foundation\Http\Controllers\FoundationController;
use Intervention\Image\ImageManager as Image;
use Modules\Seller\Repositories\Contracts\SellerRepositoryInterface;


class AssociationController extends FoundationController {


    protected $association;

    protected $associationKeyMembers;

    protected $associationInvite;

    protected $userAssociation;

    protected $auth;

    protected $image;

    protected $folder;


    public function __construct(AssociationRepositoryInterface $association, UserAssociationRepositoryInterface $userAssociation, AssociationInviteRepositoryInterface $associationInvite, AuthRepositoryInterface $auth, AssociationKeyMemberRepositoryInterface $keyMemberRepositoryInterface, SellerRepositoryInterface $seller)
    {
        $this->association = $association;
        $this->associationKeyMembers = $keyMemberRepositoryInterface;
        $this->associationInvite = $associationInvite;
        $this->userAssociation = $userAssociation;
        $this->auth = $auth;
        $this->seller = $seller;
    }

    /**
     * Clean request of unwanted keys.
     *
     * @param $request
     * @return mixed
     */

    protected function getUpdateAssociationInformation($request)
    {
        return $request->only(['name','suburb_id','state_id','breed','about']);
    }

    /**
     * Makes request for creating association.
     *
     * @param AssociationRequest $request
     * @param AssociationRequestModel $associationRequestModel
     * @return \Dingo\Api\Http\Response|void
     */

    public function postAssociation(AssociationRequest $request, AssociationRequestModel $associationRequestModel)
    {
        if ($associationRequestModel->create($request->input()))
        {
            return $this->response->created();
        }
        return $this->response->errorInternal();
    }

    /**
     * Update all association information.
     * @param AssociationRequest $request
     */

    public function putAssociation(AssociationRequest $request)
    {
        if ($this->association->findByColumn(['user_id'=>$this->getAuthenticatedUserId()]))
        {
            if($this->association->update($this->getAuthenticatedUserId(),$this->getUpdateAssociationInformation($request),false))
            {
                return $this->association->findByColumn(['user_id'=>$this->getAuthenticatedUserId()]);
            }
            return $this->response->errorInternal();
        }
        return $this->response->error('Association not found.', 404);
    }

    /**
     * Updates some of the association information.
     *
     * @param AssociationRequest $request
     */

    public function patchAssociation(AssociationRequest $request)
    {
        if ($this->association->findByColumn(['user_id'=>$this->getAuthenticatedUserId()]))
        {
            if($this->association->update($this->getAuthenticatedUserId(),$this->getUpdateAssociationInformation($request),false))
            {
                return $this->association->findByColumn(['user_id'=>$this->getAuthenticatedUserId()]);
            }
            return $this->response->errorInternal();
        }
        return $this->response->error('Association not found.', 404);
    }

    /**
     * Sends request to join association to seller.
     *
     * @param AssociationMemberRequest $request
     * @param AuthRepositoryInterface $auth
     * @return \Dingo\Api\Http\Response|void
     */

    public function postAssociationMembers(AssociationMemberRequest $request, AuthRepositoryInterface $auth)
    {
        if(!$this->associationInvite->findByColumn(['association_id' => $this->getAuthenticatedUserId(),'member_email' => $request->input('member_email')]))
        {
            $id = $auth->findByColumn(['email'=>$request->input('member_email')],['id']);
            $seller = $this->seller->findByColumn(['user_id'=> $id['id']],['suburb_id','state_id']);
            $request->merge(['association_id'=>$this->getAuthenticatedUserId(),'seller_id' => $id['id'],'requested'=>'association','suburb_id' => $seller['suburb_id'],'state_id' => $seller['state_id']]);
            if ($this->associationInvite->create($request->input()))
            {
                return $this->response->created("Request has been accepted, you will be notified.");
            }
            return $this->response->errorInternal();
        }
        return $this->response->errorForbidden("Invite is allready sent to this user!");
    }

    /**
     * Deletes member from association.
     *
     * @param AssociationMemberRequest $request
     * @return \Illuminate\Http\JsonResponse|void
     */

    public function deleteAssociationMembers(AssociationMemberRequest $request)
    {
        if(!$this->userAssociation->attributeExists(["seller_id"=>$request->input('id'), "association_id"=>$this->getAuthenticatedUserId()]))
        {
            return $this->response->error('User not found.', 404);
        }
        $this->userAssociation->deleteCustom(["seller_id" => $request->input('id')]);
        return response()->json("", 200);
    }

    /**
     * Creates folder structure for images.
     *
     * @param Filesystem $folder
     */

    protected function createFolderStructure(Filesystem $folder)
    {
        $this->folder = $folder;
        if(!$this->folder->isDirectory(base_path('public/uploads/association/') . $this->getAuthenticatedUserId()))
        {
            $this->folder->makeDirectory(base_path('public/uploads/association/') . $this->getAuthenticatedUserId());
        }
        if(!$this->folder->isDirectory(base_path('public/uploads/association/') . $this->getAuthenticatedUserId(). "/avatar"))
        {
            $this->folder->makeDirectory(base_path('public/uploads/association/' . $this->getAuthenticatedUserId()) . "/avatar");
        }
        if(!$this->folder->isDirectory(base_path('public/uploads/association/') . $this->getAuthenticatedUserId(). "/banner"))
        {
            $this->folder->makeDirectory(base_path('public/uploads/association/' . $this->getAuthenticatedUserId()) . "/banner");
        }
        if(!$this->folder->isDirectory(base_path('public/uploads/association/') . $this->getAuthenticatedUserId(). "/gallery"))
        {
            $this->folder->makeDirectory(base_path('public/uploads/association/' . $this->getAuthenticatedUserId()) . "/gallery");
        }
    }

    /**
     * Gets uploaded images and saves them to predefined folder structure.
     *
     * @param AssociationImageRequest $request
     * @param Image $image
     * @param Filesystem $folder
     */

    public function postAssociationImages(AssociationImageRequest $request, Image $image,Filesystem $folder)
    {
        $this->image = $image;
        $this->createFolderStructure($folder);
        $avatar = $this->image->make($_FILES['avatar']['tmp_name']);
        $avatar->resize(50,50);
        $avatar->save(base_path('public/uploads/association/'.$this->getAuthenticatedUserId()).'/avatar/'.$this->getAuthenticatedUserId().'.jpg');
        $this->association->update($this->getAuthenticatedUserId(),['avatar' => (base_path('public/uploads/association/'.$this->getAuthenticatedUserId()).'/avatar/'.$this->getAuthenticatedUserId().'.jpg')],false);
        $banner = $this->image->make($_FILES['banner']['tmp_name']);
        $banner->save(base_path('public/uploads/association/'.$this->getAuthenticatedUserId()).'/banner/'.$this->getAuthenticatedUserId().'.jpg');
        $this->association->update($this->getAuthenticatedUserId(),['banner_image' => (base_path('public/uploads/association/'.$this->getAuthenticatedUserId()).'/banner/'.$this->getAuthenticatedUserId().'.jpg')],false);
        foreach($_FILES['images']['tmp_name'] as $key => $image)
        {
            if($key <= 2)
            {
                $images = $this->image->make($image);
                $images->save(base_path('public/uploads/association/' . $this->getAuthenticatedUserId()) . '/gallery/' . $key . '.jpg');
            }
        }
    }

    /**
     * Adds key members of association to table. Support for adding multiple key members in one request.
     *
     * @param AssociationKeyMembersRequest $request
     * @param AssociationKeyMemberModel $associationKeyMemberModel
     * @return \Dingo\Api\Http\Response|void
     */


    public function postAssociationKeyMembers(AssociationKeyMembersRequest $request, AssociationKeyMemberModel $associationKeyMemberModel)
    {
        if(!((count($request->input('type')) == count($request->input('name'))) && (count($request->input('name')) == count($request->input('email')))))
        {
            return $this->response->errorBadRequest("Not all data is provided.");
        }
        foreach($request->input('email') as $index => $mail)
        {
            if($this->auth->attributeExists(['email'=> $mail]))
            {
                $id = $this->auth->findByColumn(['email'=> $mail],['id']);
                $associationKeyMemberModel->create(['association_id'=>$this->getAuthenticatedUserId(),'type'=>$request->input('type')[$index], 'name'=>$request->input('name')[$index],'email'=>$mail,'user_id'=>$id['id'] ]);
            }else
            {
                $associationKeyMemberModel->create(['association_id'=>$this->getAuthenticatedUserId(),'type'=>$request->input('type')[$index], 'name'=>$request->input('name')[$index],'email'=>$mail]);
            }
        }
        return $this->response->created();
    }

    /**
     * Deletes key member from table, based on id sent with request.
     *
     * @param AssociationKeyMembersRequest $request
     * @return \Illuminate\Http\JsonResponse|void
     */

    public function deleteAssociationKeyMembers(AssociationKeyMembersRequest $request)
    {
        if($this->associationKeyMembers->attributeExists(['id' => $request->input('id'),'association_id' => $this->getAuthenticatedUserId()]))
        {
            $this->associationKeyMembers->delete($request->input('id'));
            return response()->json("", 200);
        }
        return $this->response()->errorBadRequest('Keymember belongs to other association');
    }

    /**
     * Search associations by slug.
     *
     * @param Request $request
     */

    public function getAssociationSlug(Request $request)
    {
        if($associationData=$this->association->findByColumn(['slug'=>$request->route('slug')]))
        {
            return $this->association->getRelatedCustom(['members.user.seller.dogs','breed','suburb','state','key_members'],['slug'=>$request->route('slug')]);
        }
        return $this->response->errorNotFound('Slug not found.');
    }

    /**
     * Send enquiry to association
     *
     * @param AssociationEnquiryRequest $request
     * @param AssociationEnquiryModel $associationEnquiryModel
     * @return \Dingo\Api\Http\Response|void
     */

    public function postAssociationEnquiry(AssociationEnquiryRequest $request, AssociationEnquiryModel $associationEnquiryModel)
    {
        if($associationEnquiryModel->create($request->input()))
        {
            return $this->response->created();
        }
        return $this->response->errorInternal();

    }

    /**
     * Returns information related to association model.
     *
     * @param AssociationWithRequest $request
     * @param Repository $config
     * @return mixed
     */

    public function getAssociationWith(AssociationWithRequest $request, Repository $config)
    {
        $relations = explode(",",$request->input('relations'));
        foreach($relations as $key => $relation)
        {
            if($config->offsetExists('association.model.pivots.association.'.$relation))
            {
                $relations[$key] = $config->get('association.model.pivots.association.'.$relation);
            }
        }
        return $this->association->getRelatedCustom($relations,['user_id' => $this->getAuthenticatedUserId()]);
    }

    public function getAssociationFrontPage(Request $request, StaffPickAssociationModel $associationModel)
    {
        return $associationModel->with('association')->limit(2)->get();
    }

}