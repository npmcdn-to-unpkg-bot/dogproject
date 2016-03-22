<?php namespace Modules\Dog\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Config\Repository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Repositories\Contracts\AuthRepositoryInterface;
use Modules\Auth\Repositories\Entities\AuthModel;
use Modules\Dog\Http\Requests\DogFatherImageRequest;
use Modules\Dog\Http\Requests\DogFatherRequest;
use Modules\Dog\Http\Requests\DogImageRequest;
use Modules\Dog\Http\Requests\DogListingRequest;
use Modules\Dog\Http\Requests\DogMotherImageRequest;
use Modules\Dog\Http\Requests\DogMotherRequest;
use Modules\Dog\Http\Requests\DogParentsImageRequest;
use Modules\Dog\Http\Requests\DogRequest;
use Modules\Dog\Http\Requests\DogRescueImageRequest;
use Modules\Dog\Http\Requests\DogRescueRequest;
use Modules\Dog\Http\Requests\DogRescueWithRequest;
use Modules\Dog\Http\Requests\DogWithRequest;
use Modules\Dog\QueryBuilderTrait;
use Modules\Dog\Repositories\Contracts\DogFatherRepositoryInterface;
use Modules\Dog\Repositories\Contracts\DogMotherRepositoryInterface;
use Modules\Dog\Repositories\Contracts\DogRepositoryInterface;
use Modules\Dog\Repositories\Contracts\DogRescueRepositoryInterface;
use Modules\Dog\Repositories\Entities\DogModel;
use Modules\Dog\Repositories\Entities\StaffPickDogModel;
use Modules\Foundation\Http\Controllers\FoundationController;
use Intervention\Image\ImageManager as Image;
use Modules\Foundation\Repositories\Entities\DogBreedModel;
use Modules\Seller\Repositories\Contracts\SellerRepositoryInterface;
use Modules\Shelter\Repositories\Contracts\ShelterRepositoryInterface;

class DogController extends FoundationController {

    use QueryBuilderTrait;

    protected $dog;
    protected $auth;
    protected $breed;
    protected $carbon;
    protected $seller;
    protected $shelter;
    protected $image;
    protected $dogMother;
    protected $dogFather;

    public function __construct(DogRepositoryInterface $dog, DogMotherRepositoryInterface $dogMother, DogFatherRepositoryInterface $dogFather, SellerRepositoryInterface $seller, ShelterRepositoryInterface $shelter, AuthRepositoryInterface $auth, DogBreedModel $breed, Carbon $carbon)
    {
        $this->dog = $dog;
        $this->auth = $auth;
        $this->breed = $breed;
        $this->carbon = $carbon;
        $this->seller = $seller;
        $this->shelter = $shelter;
        $this->dogMother = $dogMother;
        $this->dogFather = $dogFather;
    }

    /**
     * Clean request for updating.
     *
     * @param $request
     * @return mixed
     */

    protected function getUpdateDogInformation($request)
    {
        if($request->input('type_of_listing') == "litter")
        {
            return $request->only(['type_of_listing','breed_id', 'male_qty','female_qty', 'cost', 'about','vaccination','vet_checked','desexed','de_warmed','micro_chipped','registration_papers','birth_date','mother_id','father_id']);
        }elseif($request->input('type_of_listing') == "rescue")
        {
            return $request->only(['type_of_listing','breed_id','name','birth_date', 'sex', 'cost', 'about','vaccination','vet_checked','desexed','de_warmed','micro_chipped','registration_papers','family_dog','indoor_dog','energetic','friendly','outdoor_dog','relaxed']);
        }else
        {
            return $request->only(['type_of_listing', 'breed_id', 'sex', 'cost', 'about', 'vaccination', 'vet_checked', 'desexed', 'de_warmed', 'micro_chipped', 'registration_papers', 'birth_date','mother_id','father_id']);
        }
    }

    /**
     * Clean request for rescue dog updating
     *
     * @param $request
     * @return mixed
     */

    protected function getPostDogInformation($request)
    {
        if($request->input('type_of_listing') == "litter")
        {
            return $request->only(['type_of_listing','breed_id', 'male_qty','female_qty', 'cost', 'about','mother_id','father_id','vaccination','vet_checked','desexed','de_warmed','micro_chipped','registration_papers','birth_date']);
        }elseif($request->input('type_of_listing') == "rescue")
        {
            return $request->only(['type_of_listing','breed_id','name','birth_date', 'sex', 'cost', 'about','vaccination','vet_checked','desexed','de_warmed','micro_chipped','registration_papers','family_dog','indoor_dog','energetic','friendly','outdoor_dog','relaxed']);
        }else
        {
            return $request->only(['type_of_listing', 'breed_id', 'sex', 'cost', 'about', 'mother_id', 'father_id', 'vaccination', 'vet_checked', 'desexed', 'de_warmed', 'micro_chipped', 'registration_papers', 'birth_date']);
        }
    }

    protected function getUpdateDogParentInformation($request)
    {
        return  $request->only(['name','breed_id','birth_date','temperament','energy','intelligence','maintenance']);
    }

    /**
     * Create folder structure for saving rescue dogs photos.
     *
     * @param Filesystem $folder
     * @param $request
     */

    protected function createDogRescueFolderStructure(Filesystem $folder,$request)
    {
        $this->folder = $folder;
        if(!$this->folder->isDirectory(base_path('public/uploads/shelter/') . $this->getAuthenticatedUserId().'/dogs/'.$request->input('id')))
        {
            if(!$this->folder->isDirectory(base_path('public/uploads/shelter/') . $this->getAuthenticatedUserId().'/dogs'))
            {
                if(!$this->folder->isDirectory(base_path('public/uploads/shelter/') . $this->getAuthenticatedUserId()))
                {
                    $this->folder->makeDirectory(base_path('public/uploads/shelter/') . $this->getAuthenticatedUserId());
                    $this->folder->makeDirectory(base_path('public/uploads/shelter/') . $this->getAuthenticatedUserId(). '/dogs');
                }else
                {
                    $this->folder->makeDirectory(base_path('public/uploads/shelter/') . $this->getAuthenticatedUserId() . '/dogs');
                }
            }
            $this->folder->makeDirectory(base_path('public/uploads/shelter/') . $this->getAuthenticatedUserId() . '/dogs/' . $request->input('id'));
        }
    }

    /**
     * Create folder structure for dog mother pictures.
     *
     * @param Filesystem $folder
     * @param $request
     */

    protected function createDogMotherFolderStructure(Filesystem $folder, $request)
    {
        $this->folder = $folder;
        if(!$this->folder->isDirectory(base_path('public/uploads/dogs/') . $this->getAuthenticatedUserId().'/mother/'.$request->input('mother_id')))
        {
            if(!$this->folder->isDirectory(base_path('public/uploads/dogs/') . $this->getAuthenticatedUserId().'/mother'))
            {
                if(!$this->folder->isDirectory(base_path('public/uploads/dogs/') . $this->getAuthenticatedUserId()))
                {
                    $this->folder->makeDirectory(base_path('public/uploads/dogs/') . $this->getAuthenticatedUserId());
                    $this->folder->makeDirectory(base_path('public/uploads/dogs/') . $this->getAuthenticatedUserId(). '/mother');
                }else
                {
                    $this->folder->makeDirectory(base_path('public/uploads/dogs/') . $this->getAuthenticatedUserId() . '/mother');
                }
            }
            $this->folder->makeDirectory(base_path('public/uploads/dogs/') . $this->getAuthenticatedUserId() . '/mother/' . $request->input('mother_id'));
        }
    }

    /**
     * Create folder structure for dog father pictures.
     *
     * @param Filesystem $folder
     * @param $request
     */

    protected function createDogFatherFolderStructure(Filesystem $folder, $request)
    {
        $this->folder = $folder;
        if(!$this->folder->isDirectory(base_path('public/uploads/dogs/') . $this->getAuthenticatedUserId().'/father/'.$request->input('father_id')))
        {
            if(!$this->folder->isDirectory(base_path('public/uploads/dogs/') . $this->getAuthenticatedUserId().'/father'))
            {
                if(!$this->folder->isDirectory(base_path('public/uploads/dogs/') . $this->getAuthenticatedUserId()))
                {
                    $this->folder->makeDirectory(base_path('public/uploads/dogs/') . $this->getAuthenticatedUserId());
                    $this->folder->makeDirectory(base_path('public/uploads/dogs/') . $this->getAuthenticatedUserId(). '/father');
                }else
                {
                    $this->folder->makeDirectory(base_path('public/uploads/dogs/') . $this->getAuthenticatedUserId() . '/father');
                }
            }
            $this->folder->makeDirectory(base_path('public/uploads/dogs/') . $this->getAuthenticatedUserId() . '/father/' . $request->input('father_id'));
        }
    }

    /**
     * Create dog slug
     *
     * @param $breed_id
     * @param $owner_id
     * @return string
     */

    protected function createDogSlug($breed_id,$owner_id)
    {
        $breed = $this->breed->find($breed_id);
        $owner = $this->auth->findById($owner_id);
        do{
            $now = $this->carbon->now();
            $slug = $breed->breed.$owner->first_name.$owner->last_name.$now->timestamp;
        }while($this->dog->attributeExists(['slug' => $slug ]));
        return $slug;
    }

    /**
     * Add new dog to listing.
     *
     * @param DogListingRequest $request
     * @param DogRequest $request
     * @return \Dingo\Api\Http\Response|void
     */

	public function postDog(DogListingRequest $request, DogRequest $request)
	{
        if($this->dogMother->attributeExists(['id'=>$request->input('mother_id'),'seller_id' => $this->getAuthenticatedUserId() ]))
        {
            if($this->dogFather->attributeExists(['id'=>$request->input('father_id'),'seller_id' => $this->getAuthenticatedUserId() ]))
            {
                $data = $this->getPostDogInformation($request);
                $location = $this->seller->findByColumn(['user_id' => $this->getAuthenticatedUserId()], ['suburb_id', 'state_id']);
                $data['slug'] = $this->createDogSlug($request->input('breed_id'),$this->getAuthenticatedUserId());
                $data['seller_id'] = $this->getAuthenticatedUserId();
                $data['suburb_id'] = $location['suburb_id'];
                $data['state_id'] = $location['state_id'];
                if ($this->dog->create($data))
                {
                    return $this->response->created();
                }
                return $this->response->errorInternal();
            }
            return $this->response()->errorBadRequest('Dog father belongs to other seller.');
        }
        return $this->response()->errorBadRequest('Dog mother belongs to other seller.');
	}

    /**
     * Update dog information - full.
     *
     * @param DogListingRequest $request
     * @param DogRequest $request
     */

    public function putDog(DogListingRequest $request, DogRequest $request)
    {
        if($this->dogMother->attributeExists(['id'=>$request->input('mother_id'),'seller_id' => $this->getAuthenticatedUserId() ]))
        {
            if($this->dogFather->attributeExists(['id'=>$request->input('father_id'),'seller_id' => $this->getAuthenticatedUserId() ]))
            {
                if($this->dog->attributeExists(['id'=> $request->input('id'),'seller_id'=>$this->getAuthenticatedUserId()]))
                {
                    if ($this->dog->attributeExists(['type_of_listing' => $request->input('type_of_listing'), 'id' => $request->input('id')])) {
                        $data = $this->getUpdateDogInformation($request);
                        if ($this->dog->update($request->input('id'), $data, true))
                        {
                            return $this->dog->findByColumn(['id' => $request->input('id')]);
                        }
                        return $this->response->errorInternal();
                    }
                    return $this->response->errorBadRequest("Wrong type of listing.");
                }
                return $this->response->errorBadRequest("Dog belongs to other seller.");
            }
            return $this->response()->errorBadRequest('Dog father belongs to other seller.');
        }
        return $this->response()->errorBadRequest('Dog mother belongs to other seller.');

    }

    /**
     * Update dog information (partial).
     *
     * @param DogListingRequest $request
     * @param DogRequest $request
     */

    public function patchDog(DogListingRequest $request, DogRequest $request)
    {
        if($this->dogMother->attributeExists(['id'=>$request->input('mother_id'),'seller_id' => $this->getAuthenticatedUserId() ]))
        {
            if($this->dogFather->attributeExists(['id'=>$request->input('father_id'),'seller_id' => $this->getAuthenticatedUserId() ]))
            {
                if($this->dog->attributeExists(['id'=> $request->input('id'),'seller_id'=>$this->getAuthenticatedUserId()]))
                {
                    if ($this->dog->attributeExists(['type_of_listing' => $request->input('type_of_listing'), 'id' => $request->input('id')])) {
                        $data = $this->getUpdateDogInformation($request);
                        if ($this->dog->update($request->input('id'), $data, true))
                        {
                            return $this->dog->findByColumn(['id' => $request->input('id')]);
                        }
                        return $this->response->errorInternal();
                    }
                    return $this->response->errorBadRequest("Wrong type of listing.");
                }
                return $this->response->errorBadRequest("Dog belongs to other seller.");
            }
            return $this->response()->errorBadRequest('Dog father belongs to other seller.');
        }
        return $this->response()->errorBadRequest('Dog mother belongs to other seller.');
    }

    /**
     * Delete a dog
     *
     * @param DogRequest $request
     * @return \Illuminate\Http\JsonResponse|void
     */

    public function deleteDog(DogRequest $request)
    {
        if (!$this->dog->attributeExists(["seller_id" => $this->getAuthenticatedUserId(), "id" => $request->input('id')]))
        {
            return $this->response->errorBadRequest('Dog belongs to other seller.');
        }
        $this->dog->deleteCustom(["id" => $request->input('id')]);
        return response()->json("", 200);

    }

    /**
     * Add new dog mother.
     *
     * @param DogMotherRequest $request
     */

    public function postDogMother(DogMotherRequest $request)
    {
        $request->merge(['seller_id'=>$this->getAuthenticatedUserId()]);
        if ($id = $this->dogMother->create($request->input())) {
            return $id->id;
        }
        return $this->response->errorInternal();
    }

    /**
     * Update complete dog mother resource
     *
     * @param DogMotherRequest $request
     */

    public function putDogMother(DogMotherRequest $request)
    {
        if($this->dogMother->attributeExists(['seller_id'=>$this->getAuthenticatedUserId(),'id'=>$request->input('id')]))
        {
            $data = $this->getUpdateDogParentInformation($request);
            $data['seller_id'] = $this->getAuthenticatedUserId();
            if ($id = $this->dogMother->update($request->input('id'),$data,true)) {
                return $this->dogMother->findByColumn(['id' => $id]);
            }
            return $this->response->errorInternal();
        }
        return $this->response->errorBadRequest('Dog belongs to other seller.');
    }

    /**
     * Update partial dog mother resource
     *
     * @param DogMotherRequest $request
     */

    public function patchDogMother(DogMotherRequest $request)
    {
        if($this->dogMother->attributeExists(['seller_id'=>$this->getAuthenticatedUserId(),'id'=>$request->input('id')]))
        {
            $data = $this->getUpdateDogParentInformation($request);
            $data['seller_id'] = $this->getAuthenticatedUserId();
            if ($id = $this->dogMother->update($request->input('id'),$data,true)) {
                return $this->dogMother->findByColumn(['id' => $id]);
            }
            return $this->response->errorInternal();
        }
        return $this->response->errorBadRequest('Dog belongs to other seller.');
    }

    /**
     * Save dog mother image and update field in table.
     *
     * @param Image $image
     * @param DogMotherImageRequest $request
     * @param Filesystem $folder
     */

    public function postDogMotherImage(Image $image, DogMotherImageRequest $request, Filesystem $folder)
    {
        if($this->dogMother->attributeExists(['id'=>$request->input('mother_id'),'seller_id'=>$this->getAuthenticatedUserId()]))
        {
            $this->image = $image;
            $this->createDogMotherFolderStructure($folder, $request);
            $image = $this->image->make($_FILES['image']['tmp_name']);
            $image->save(base_path('public/uploads/dogs/' . $this->getAuthenticatedUserId()) . '/mother/' . $request->input('mother_id') . '/' . $request->input('mother_id') . '.jpg');
            $this->dogMother->update($request->input('mother_id'), ['image' => (base_path('public/uploads/dogs/' . $this->getAuthenticatedUserId()) . '/mother/' . $request->input('mother_id') . '/' . $request->input('mother_id') . '.jpg')], true);
            return $this->dogMother->findByColumn(['id' => $request->input('mother_id')]);
        }
        return $this->response()->errorBadRequest('Mother dog belongs to other seller.');
    }

    /**
     * Save dog father image and update field in table.
     *
     * @param Image $image
     * @param DogFatherImageRequest $request
     * @param Filesystem $folder
     */

    public function postDogFatherImage(Image $image, DogFatherImageRequest $request, Filesystem $folder)
    {
        if($this->dogFather->attributeExists(['id'=>$request->input('father_id'),'seller_id'=>$this->getAuthenticatedUserId()]))
        {
            $this->image = $image;
            $this->createDogFatherFolderStructure($folder, $request);
            $image = $this->image->make($_FILES['image']['tmp_name']);
            $image->save(base_path('public/uploads/dogs/' . $this->getAuthenticatedUserId()) . '/father/' . $request->input('father_id') . '/' . $request->input('father_id') . '.jpg');
            $this->dogFather->update($request->input('father_id'), ['image' => (base_path('public/uploads/dogs/' . $this->getAuthenticatedUserId()) . '/father/' . $request->input('father_id') . '/' . $request->input('father_id') . '.jpg')], true);
            return $this->dogFather->findByColumn(['id' => $request->input('father_id')]);
        }
        return $this->response()->errorBadRequest('Father dog belongs to other seller.');
    }

    /**
     * Delete dog mother.
     *
     * @param DogMotherRequest $request
     * @return \Illuminate\Http\JsonResponse|void
     */

    public function deleteDogMother(DogMotherRequest $request)
    {
        if($this->dogMother->attributeExists(['id'=>$request->input('id'),'seller_id' => $this->getAuthenticatedUserId()]))
        {
            //$id = $this->dog->findByColumnAll(['mother_id'=>$request->input('id')],['id']);
            $this->dogMother->deleteCustom(["id" => $request->input('id')]);
//            foreach($id as $attributes)
//            {
//                $this->dog->update($attributes['attributes']['id'],['mother_id'=>0],true,true);
//            }
            return response()->json("", 200);
        }
        return $this->response->errorBadRequest("Dog mother does not belong to this seller.");
    }

    /**
     * Add dog father.
     *
     * @param DogFatherRequest $request
     */

    public function postDogFather(DogFatherRequest $request)
    {
        $request->merge(['seller_id'=>$this->getAuthenticatedUserId()]);
        if($id = $this->dogFather->create($request->input()))
        {
            return $id->id;
        }
        return $this->response->errorInternal();
    }

    /**
     * Updates whole dog father resource
     *
     * @param DogFatherRequest $request
     */

    public function putDogFather(DogFatherRequest $request)
    {
        if($this->dogFather->attributeExists(['seller_id'=>$this->getAuthenticatedUserId(),'id'=>$request->input('id')]))
        {
            $data = $this->getUpdateDogParentInformation($request);
            $data['seller_id'] = $this->getAuthenticatedUserId();
            if ($id = $this->dogFather->update($request->input('id'),$data,true)) {
                return $this->dogFather->findByColumn(['id' => $id]);
            }
            return $this->response->errorInternal();
        }
        return $this->response->errorBadRequest('Dog belongs to other seller.');
    }

    /**
     * Updates partial dog father resource
     *
     * @param DogFatherRequest $request
     */

    public function patchDogFather(DogFatherRequest $request)
    {
        if($this->dogFather->attributeExists(['seller_id'=>$this->getAuthenticatedUserId(),'id'=>$request->input('id')]))
        {
            $data = $this->getUpdateDogParentInformation($request);
            $data['seller_id'] = $this->getAuthenticatedUserId();
            if ($id = $this->dogFather->update($request->input('id'),$data,true)) {
                return $this->dogFather->findByColumn(['id' => $id]);
            }
            return $this->response->errorInternal();
        }
        return $this->response->errorBadRequest('Dog belongs to other seller.');
    }

    /**
     * Delete dog father by id.
     *
     * @param DogFatherRequest $request
     * @return \Illuminate\Http\JsonResponse|void
     */

    public function deleteDogFather(DogFatherRequest $request)
    {
        if($this->dog->attributeExists(['father_id'=>$request->input('id'),'seller_id' => $this->getAuthenticatedUserId()]))
        {
            //$id = $this->dog->findByColumnAll(['father_id'=>$request->input('id')],['id']);
            $this->dogFather->deleteCustom(["id" => $request->input('id')]);
//            foreach($id as $attributes)
//            {
//                $this->dog->update($attributes['attributes']['id'],['father_id'=>0],true,true);
//            }
            return response()->json("", 200);
        }
        return $this->response->errorBadRequest("Dog father does not belong to this seller.");
    }

    /**
     * Create folder structure for pictures.
     *
     * @param Filesystem $folder
     * @param $dog_id
     */

    protected function createFolderStructure(Filesystem $folder, $dog_id)
    {
        $this->folder = $folder;
        if(!$this->folder->isDirectory(base_path('public\uploads\dogs\\') . $this->getAuthenticatedUserId()))
        {
            $this->folder->makeDirectory(base_path('public\uploads\dogs\\') . $this->getAuthenticatedUserId());
        }
        if(!$this->folder->isDirectory(base_path('public\uploads\dogs\\') . $this->getAuthenticatedUserId().'\\'. $dog_id))
        {
            $this->folder->makeDirectory(base_path('public\uploads\dogs\\' . $this->getAuthenticatedUserId()) .'\\'. $dog_id);
        }
    }

    /**
     * Save images to disk.
     *
     * @param DogImageRequest $request
     * @param Image $image
     * @param Filesystem $folder
     */

    public function postDogImages(DogImageRequest $request, Image $image, Filesystem $folder)
    {
        $this->image = $image;
        $this->createFolderStructure($folder,$request->input('dog_id'));
        foreach($_FILES['images']['tmp_name'] as $key => $image)
        {
            if($key <= 1)
            {
                $images = $this->image->make($image);
                $images->save(base_path('public\uploads\dogs\\' . $this->getAuthenticatedUserId()) . '\\' . $request->input('dog_id') . '\\' . $key . '.jpg');
            }
        }
    }


    /**
     * Search through dog and rescue listing
     *
     * @param DogRequest $request
     */

    public function getDog(DogRequest $request)
    {
        $table = $this->table("dog_entities");
        if($request->has('filter'))
        {
            $table->filter($request->input('filter'));
        }
        return $table->paginate();
    }

    /**
     * Get dog related information
     *
     * @param DogWithRequest $request
     * @param Repository $config
     * @return mixed
     */

    public function getDogWith(DogWithRequest $request, Repository $config)
    {
        $relations = explode(",",$request->input('relations'));
        foreach($relations as $key => $relation)
        {
            if($value = $config->offsetExists('dog.model.pivots.dog.'.$relation))
            {
                if(is_array($value))
                {
                    foreach($value as $bla)
                    {
                        $relations[$key] = $bla;
                    }
                }
                $relations[$key] = $config->get('dog.model.pivots.dog.'.$relation);
            }
        }
        return $this->dog->getRelatedCustom($relations);
    }


    /**
     * Create rescue dog resource
     *
     * @param DogRescueRequest $request
     * @return \Dingo\Api\Http\Response|void
     */


    public function postDogRescue(DogRescueRequest $request)
    {
        $request->merge(['type_of_listing' => 'rescue']);
        $data = $this->getUpdateDogInformation($request);
        $location = $this->shelter->findByColumn(['user_id'=>$this->getAuthenticatedUserId()],['suburb_id','state_id']);
        $data['seller_id']=$this->getAuthenticatedUserId();
        $data['suburb_id']=$location['suburb_id'];
        $data['state_id']=$location['state_id'];
        if ($this->dog->create($data))
        {
            return $this->response->created();
        }
        return $this->response->errorInternal();
    }

    /**
     * Edit whole rescue dog resource
     *
     * @param DogRescueRequest $request
     */

    public function putDogRescue(DogRescueRequest $request)
    {
        if($this->dog->attributeExists(['seller_id'=>$this->getAuthenticatedUserId(),'id'=>$request->input('id')]))
        {
            if($this->dog->attributeExists(['type_of_listing' => 'rescue','id'=> $request->input('id')]))
            {
                $request->merge(['type_of_listing' => 'rescue']);
                $data = $this->getUpdateDogInformation($request);
                $data['seller_id'] = $this->getAuthenticatedUserId();
                if ($this->dog->update($request->input('id'), $data, true)) {
                    return $this->dog->findByColumn(['id' => $request->input('id')]);
                }
                return $this->response->errorInternal();
            }
            return $this->response()->errorBadRequest("Wrong type of listing");
        }
        return $this->response->errorBadRequest('Dog belongs to other shelter.');
    }

    /**
     * Edit partial rescue dog resource
     *
     * @param DogRescueRequest $request
     */

    public function patchDogRescue(DogRescueRequest $request)
    {
        if($this->dog->attributeExists(['seller_id'=>$this->getAuthenticatedUserId(),'id'=>$request->input('id')]))
        {
            if($this->dog->attributeExists(['type_of_listing' => 'rescue','id'=> $request->input('id')]))
            {
                $request->merge(['type_of_listing' => 'rescue']);
                $data = $this->getUpdateDogInformation($request);
                $data['seller_id'] = $this->getAuthenticatedUserId();
                if ($this->dog->update($request->input('id'), $data, true)) {
                    return $this->dog->findByColumn(['id' => $request->input('id')]);
                }
                return $this->response->errorInternal();
            }
            return $this->response()->errorBadRequest("Wrong type of listing");
        }
        return $this->response->errorBadRequest('Dog belongs to other shelter.');
    }

    /**
     * Upload rescue dog images.
     *
     * @param DogRescueImageRequest $request
     * @param Image $image
     * @param Filesystem $folder
     */

    public function postDogRescueImages(DogRescueImageRequest $request, Image $image, Filesystem $folder)
    {
        if($this->dog->attributeExists(['id'=>$request->input('id'),'seller_id'=>$this->getAuthenticatedUserId()]))
        {
            $this->image = $image;
            $this->createDogRescueFolderStructure($folder, $request);
            foreach ($_FILES['images']['tmp_name'] as $key => $image) {
                if ($key <= 2) {
                    $images = $this->image->make($image);
                    $images->save(base_path('public/uploads/shelter/') . $this->getAuthenticatedUserId() . '/dogs/' . $request->input('id') . '/' . $key . '.jpg');
                }
            }
            return response()->json("", 200);
        }
        return $this->response()->errorBadRequest('Dog belongs to other shelter');

    }

    /**
     * Get all mother dogs for authenticated seller
     *
     * @param Request $request
     * @return mixed
     */

    public function getDogMother(Request $request)
    {
        return $this->dogMother->getRelatedCustom(['breed'],['seller_id'=>$this->getAuthenticatedUserId()]);
    }

    /**
     * Get all father dogs for authenticated seller
     *
     * @param Request $request
     * @return mixed
     */

    public function getDogFather(Request $request)
    {
        return $this->dogFather->getRelatedCustom(['breed'],['seller_id'=>$this->getAuthenticatedUserId()]);
    }

    /**
     * Get dog by id.
     *
     * @param Request $request
     */

    public function getDogId(Request $request)
    {
        if($dog = $this->dog->findById($request->route('id')))
        {
            return $dog;
        }
        return $this->response()->errorNotFound("Dog not found");
    }

    /**
     * Get single dog information with related information
     *
     * @param DogWithRequest $request
     * @param Repository $config
     * @return mixed
     */

    public function getDogIdWith(DogWithRequest $request, Repository $config)
    {
        $relations = explode(",",$request->input('relations'));
        foreach($relations as $key => $relation)
        {
            if($value = $config->offsetExists('dog.model.pivots.dog.'.$relation))
            {
                if(is_array($value))
                {
                    foreach($value as $bla)
                    {
                        $relations[$key] = $bla;
                    }
                }
                $relations[$key] = $config->get('dog.model.pivots.dog.'.$relation);
            }
        }
        return $this->dog->getRelatedCustom($relations,['id'=>$request->route('id')]);
    }

    /**
     * Gets data for front page
     *
     * @param Request $request
     * @param StaffPickDogModel $dogModel
     * @return mixed
     */

    public function getDogFrontPage(Request $request, StaffPickDogModel $dogModel)
    {
         return $dogModel->with('dog')->limit(4)->get();
    }

    /**
     * Get count for listed litter for given seller
     *
     * @param Request $request
     * @return mixed
     */

    public function getDogLitterCount(Request $request)
    {
        return $this->dog->countResults(['seller_id'=> $this->getAuthenticatedUserId(),'type_of_listing'=>'litter']);

    }

	
}