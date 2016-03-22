<?php namespace Modules\Location\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Foundation\Http\Controllers\FoundationController;
use Modules\Location\Http\Requests\SuburbRequest;
use Modules\Location\Repositories\Entities\LocationStateModel;
use Modules\Location\Repositories\Entities\LocationSuburbModel;

class LocationController extends FoundationController {
	
	public function getState(Request $request, LocationStateModel $stateModel)
	{
		return $stateModel->all()->toArray();
	}

    public function getSuburb(SuburbRequest $request, LocationSuburbModel $locationSuburbModel)
    {
        return $locationSuburbModel->where('state_id','=',$request->input('state_id'))->get()->toArray();
    }
	
}