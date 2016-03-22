<?php
use Illuminate\Support\Facades\Auth;
return array(
    'title' => 'Admins',
    'single' => 'Admin',
    'model' => 'Modules\Admin\Repositories\Entities\AdminModel',
    'columns' => array(
        'id' => array(
            'type' => 'text',
            'title' => 'id'
        ),
        'username' => array(
            'type' => 'text',
            'title' => 'username'
        ),
        'role' => array(
            'type' => 'text',
            'title' => 'role'
        ),
        'password' => array(
            'type' => 'text',
            'title' => 'password'
        )
    ),
    'edit_fields' => array(
        'username' => array(
            'type' => 'text',
            'title' => 'username'
        ),
        'role' => array(
            'type' => 'text',
            'title' => 'role'
        ),
        'password' => array(
            'type' => 'text',
            'title' => 'password'
        )
    ),
    'permission' => function()
    {
        $user=Auth::driver('database')->user();
        $admin = new \Modules\Admin\Repositories\Entities\AdminModel();
        return $admin->hasRole('superadmin',$user->id);
    }

);