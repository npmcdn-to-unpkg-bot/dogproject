<?php
return array(
    'title' => 'Users',
    'single' => 'User',
    'model' => 'Modules\Auth\Repositories\Entities\AuthModel',
    'columns' => array(
        'id' => array(
            'type' => 'text',
            'title' => 'id'
        ),
        'first_name' => array(
            'type' => 'text',
            'title' => 'first_name'
        ),
        'last_name' => array(
            'type' => 'text',
            'title' => 'last_name'
        ),
        'email' => array(
            'type' => 'text',
            'title' => 'email'
        ),
        'contact_number' => array(
            'type' => 'text',
            'title' => 'contact_number'
        ),
        'password' => array(
            'type' => 'text',
            'title' => 'password'
        ),
        'role' => array(
            'type' => 'text',
            'title' => 'role'
        ),
        'status' => array(
            'type' => 'text',
            'title' => 'status'
        )
    ),
    'edit_fields' => array(
        'name' => array(
            'type' => 'text',
            'title' => 'name'
        ),
        'email' => array(
            'type' => 'text',
            'title' => 'email'
        ),
        'contact_number' => array(
            'type' => 'text',
            'title' => 'contact_number'
        ),
        'password' => array(
            'type' => 'text',
            'title' => 'password'
        ),
        'is_active' => array(
            'type' => 'text',
            'title' => 'is_active'
        )
    ),
);