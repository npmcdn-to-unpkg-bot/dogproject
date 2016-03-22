<?php namespace Modules\Shelter\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Config\Repository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager as Image;
use Modules\Auth\Repositories\Contracts\AuthRepositoryInterface;
use Modules\Dog\Repositories\Contracts\DogRepositoryInterface;
use Modules\Foundation\Http\Controllers\FoundationController;
use Modules\Shelter\Http\Requests\ShelterDogEnquiryRequest;
use Modules\Shelter\Http\Requests\ShelterEnquiryRequest;
use Modules\Shelter\Http\Requests\ShelterImageRequest;
use Modules\Shelter\Http\Requests\ShelterKeyMembersRequest;
use Modules\Shelter\Http\Requests\ShelterRequest;
use Modules\Shelter\Http\Requests\ShelterWithRequest;
use Modules\Shelter\Repositories\Contracts\ShelterEnquiryRepositoryInterface;
use Modules\Shelter\Repositories\Contracts\ShelterKeyMemberRepositoryInterface;
use Modules\Shelter\Repositories\Contracts\ShelterRepositoryInterface;
use Modules\Shelter\Repositories\Entities\ShelterEnquiryModel;
use Modules\Shelter\Repositories\Entities\ShelterKeyMemberModel;

class ShelterController extends FoundationController {

    protected $shelter;
    protected $shelterKeyMember;
    protected $dogRescue;
    protected $shelterEnquiry;
    protected $auth;
    protected $carbon;
    protected $image;

    public function __construct(ShelterRepositoryInterface $shelter, AuthRepositoryInterface $auth, ShelterEnquiryRepositoryInterface $shelterEnquiry, DogRepositoryInterface $dog, ShelterKeyMemberRepositoryInterface $keyMemberRepositoryInterface, Carbon $carbon)
    {
        $this->shelter = $shelter;
        $this->shelterKeyMember = $keyMemberRepositoryInterface;
        $this->dogRescue = $dog;
        $this->shelterEnquiry = $shelterEnquiry;
        $this->auth = $auth;
        $this->carbon = $carbon;
    }

    /**
     * Clean request for shelter updating
     *
     * @param $request
     * @return mixed
     */

    protected function getShelterInformation($request)
    {
        return $request->only(['name','web_address','address','suburb_id','state_id','facebook','twitter','instagram','about','newsletter']);
    }

    /**
     * Creates folder structure for images.
     *
     * @param Filesystem $folder
     */

    protected function createFolderStructure(Filesystem $folder)
    {
        $this->folder = $folder;
        if(!$this->folder->isDirectory(base_path('public/uploads/shelter/') . $this->getAuthenticatedUserId()))
        {
            $this->folder->makeDirectory(base_path('public/uploads/shelter/') . $this->getAuthenticatedUserId());
        }
        if(!$this->folder->isDirectory(base_path('public/uploads/shelter/') . $this->getAuthenticatedUserId(). "/avatar"))
        {
            $this->folder->makeDirectory(base_path('public/uploads/shelter/' . $this->getAuthenticatedUserId()) . "/avatar");
        }
        if(!$this->folder->isDirectory(base_path('public/uploads/shelter/') . $this->getAuthenticatedUserId(). "/advert"))
        {
            $this->folder->makeDirectory(base_path('public/uploads/shelter/' . $this->getAuthenticatedUserId()) . "/advert");
        }
        if(!$this->folder->isDirectory(base_path('public/uploads/shelter/') . $this->getAuthenticatedUserId(). "/gallery"))
        {
            $this->folder->makeDirectory(base_path('public/uploads/shelter/' . $this->getAuthenticatedUserId()) . "/gallery");
        }
    }

    /**
     * Create shelter slug
     *
     * @param $seller
     * @return string
     */

    protected function createShelterSlug($seller, $name)
    {
        $owner = $this->auth->findById($seller);
        do{
            $now = $this->carbon->now();
            $slug = $name.$owner->first_name.$owner->last_name.$now->timestamp;
        }while($this->shelter->attributeExists(['slug' => $slug ]));
        return $slug;
    }

    /**
     * Creates new dog shelter
     *
     * @param ShelterRequest $request
     * @return \Dingo\Api\Http\Response|void
     */

    public function postShelter(ShelterRequest $request)
    {
        if(!$this->shelter->attributeExists(['user_id'=>$this->getAuthenticatedUserId()]))
        {
            $slug = $this->createShelterSlug($this->getAuthenticatedUserId(), $request->input('name'));
            $request->merge(['user_id'=>$this->getAuthenticatedUserId(),'slug' => $slug]);
            if ($this->shelter->create($request->input()))
            {
                return $this->response()->created();
            }
            return $this->response->errorInternal();
        }
        return $this->response->error('Shelter with that id already exists.', 403);
    }

    /**
     * Edits whole shelter resource
     *
     * @param ShelterRequest $request
     */

    public function putShelter(ShelterRequest $request)
    {
        $data = $this->getShelterInformation($request);
        if ($this->shelter->findByColumn(['user_id'=>$this->getAuthenticatedUserId()]))
        {
            if($this->shelter->update($this->getAuthenticatedUserId(),$data,false))
            {
                return $this->shelter->findByColumn(['user_id'=>$this->getAuthenticatedUserId()]);
            }
            return $this->response->errorInternal();
        }
        return $this->response->error('Shelter not found.', 404);
    }

    /**
     * Edits partial shelter resource
     *
     * @param ShelterRequest $request
     */

    public function patchShelter(ShelterRequest $request)
    {
        $data = $this->getShelterInformation($request);
        if ($this->shelter->findByColumn(['user_id'=>$this->getAuthenticatedUserId()]))
        {
            if($this->shelter->update($this->getAuthenticatedUserId(),$data,false))
            {
                return $this->shelter->findByColumn(['user_id'=>$this->getAuthenticatedUserId()]);
            }
            return $this->response->errorInternal();
        }
        return $this->response->error('Shelter not found.', 404);
    }

    /**
     * Uploads shelter images
     *
     * @param ShelterImageRequest $request
     * @param Image $image
     * @param Filesystem $folder
     */

    public function postShelterImages(ShelterImageRequest $request, Image $image, Filesystem $folder)
    {
        $this->image = $image;
        $this->createFolderStructure($folder);
        $avatar = $this->image->make($_FILES['avatar']['tmp_name']);
        $avatar->resize(50,50);
        $avatar->save(base_path('public/uploads/shelter/'.$this->getAuthenticatedUserId()).'/avatar/'.$this->getAuthenticatedUserId().'.jpg');
        $this->shelter->update($this->getAuthenticatedUserId(),['avatar' => (base_path('public/uploads/shelter/'.$this->getAuthenticatedUserId()).'/avatar/'.$this->getAuthenticatedUserId().'.jpg')],false);
        $banner = $this->image->make($_FILES['advert_photo']['tmp_name']);
        $banner->save(base_path('public/uploads/shelter/'.$this->getAuthenticatedUserId()).'/advert/'.$this->getAuthenticatedUserId().'.jpg');
        $this->shelter->update($this->getAuthenticatedUserId(),['advert_photo' => (base_path('public/uploads/shelter/'.$this->getAuthenticatedUserId()).'/advert_photo/'.$this->getAuthenticatedUserId().'.jpg')],false);
        foreach($_FILES['images']['tmp_name'] as $key => $image)
        {
            if($key <= 3)
            {
                $images = $this->image->make($image);
                $images->save(base_path('public/uploads/shelter/' . $this->getAuthenticatedUserId()) . '/gallery/' . $key . '.jpg');
            }
        }
    }

    /**
     * Method for adding shelter key members.
     *
     * @param ShelterKeyMembersRequest $request
     * @param ShelterKeyMemberModel $shelterKeyMemberModel
     * @return \Dingo\Api\Http\Response|void
     */

    public function postShelterKeyMembers(ShelterKeyMembersRequest $request, ShelterKeyMemberModel $shelterKeyMemberModel)
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
                $shelterKeyMemberModel->create(['shelter_id'=>$this->getAuthenticatedUserId(),'type'=>$request->input('type')[$index], 'name'=>$request->input('name')[$index],'email'=>$mail,'user_id'=>$id['id'] ]);
            }else
            {
                $shelterKeyMemberModel->create(['shelter_id'=>$this->getAuthenticatedUserId(),'type'=>$request->input('type')[$index], 'name'=>$request->input('name')[$index],'email'=>$mail]);
            }
        }
        return $this->response->created();
    }

    /**
     * Method for deleting shelter key members
     *
     * @param ShelterKeyMembersRequest $request
     * @return \Illuminate\Http\JsonResponse|void
     */

    public function deleteShelterKeyMembers(ShelterKeyMembersRequest $request)
    {
        if($this->shelterKeyMember->attributeExists(['id' => $request->input('id'),'shelter_id' => $this->getAuthenticatedUserId()]))
        {
            $this->shelterKeyMember->delete($request->input('id'));
            return response()->json("", 200);
        }
        return $this->response()->errorBadRequest('Keymember belongs to other shelter');
    }

    /**
     * Sends basic enquiry to shelter
     *
     * @param ShelterEnquiryRequest $request
     * @param ShelterEnquiryModel $shelterEnquiryModel
     * @return \Dingo\Api\Http\Response|void
     */

    public function postShelterEnquiry(ShelterEnquiryRequest $request, ShelterEnquiryModel $shelterEnquiryModel)
    {
        if($shelterEnquiryModel->create($request->input()))
        {
            return $this->response->created();
        }
        return $this->response->errorInternal();
    }

    /**
     * Returns shelter with related information
     *
     * @param ShelterWithRequest $request
     * @param Repository $config
     * @return mixed
     */

	public function getShelterWith(ShelterWithRequest $request, Repository $config)
    {
        $relations = explode(",",$request->input('relations'));
        foreach($relations as $key => $relation)
        {
            if($value = $config->offsetExists('shelter.model.pivots.shelter.'.$relation))
            {
                if(is_array($value))
                {
                    foreach($value as $temp)
                    {
                        $relations[$key] = $temp;
                    }
                }
                $relations[$key] = $config->get('shelter.model.pivots.shelter.'.$relation);
            }
        }
        return $this->shelter->getRelatedCustom($relations,['user_id' => $this->getAuthenticatedUserId()]);
    }

    /**
     * Get shelter by slug with related information
     *
     * @param Request $request
     */

    public function getShelterSlug(Request $request)
    {
        if($shelterData=$this->shelter->findByColumn(['slug'=>$request->route('slug')]))
        {
            return $this->shelter->getRelatedCustom(['user','key_members','suburb','state','dogs.breed'],['slug'=>$request->route('slug')]);
        }
        return $this->response->errorNotFound('Slug not found.');

    }

    /**
     * Sends enquiry about rescuing a dog from a shelter
     *
     * @param ShelterDogEnquiryRequest $request
     * @return \Dingo\Api\Http\Response|void
     */

    public function postShelterDogEnquiry(ShelterDogEnquiryRequest $request)
    {
        if ($this->dogRescue->attributeExists(["seller_id" => $request->input('shelter_id'), "id" => $request->input('dog_id')]))
        {
            if (!$this->shelterEnquiry->findByColumn(['shelter_id' => $request->input('shelter_id'), 'dog_id' => $request->input('dog_id'), 'email' => $request->input('email')]))
            {
                if ($this->shelterEnquiry->create($request->except('review_token', 'reviewed')))
                {
                    return $this->response->created();
                }
                return $this->response->errorInternal();
            }
            return $this->response->errorForbidden("Enquiry is allready sent!");
        }
        return $this->response->errorBadRequest('Dog belongs to other shelter.');
    }
}