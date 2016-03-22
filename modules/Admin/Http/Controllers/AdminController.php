<?php namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Pingpong\Modules\Routing\Controller;

class AdminController extends Controller {
	
	public function index()
	{
		return view('Admin::index');
	}

    public function getAdminLogin(Request $request)
    {
        //dd(Auth::driver('database')->attempt(['username' => $request->input('username'), 'password' => $request->input('password')]));
        if (Auth::driver('database')->attempt(['username' => $request->input('username'), 'password' => $request->input('password')]))
        {
            return redirect('admin');
        }

        return Redirect::back('\\')
            ->withInput()
            ->withErrors('Username or Password are incorrect.');

    }
	
}