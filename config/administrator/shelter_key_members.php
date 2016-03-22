<?php
return array(
    'title' => 'Key members',
    'single' => 'Key member',
    'model' => 'Modules\Shelter\Repositories\Entities\ShelterKeyMemberModel',
    'columns' => array(
        'id' => array(
            'type' => 'text',
            'title' => 'id'
        ),
        'shelter_id' => array(
            'title' => 'Shelter name, Shelter web address',
            'relationship' => 'shelter',
            'select' => "CONCAT((:table).name, ',', (:table).web_address)"
        ),
        'type' => array(
            'type' => 'int',
            'title' => 'Type'
        ),
        'name' => array(
            'type' => 'text',
            'title' => 'Name'
        ),
        'email' => array(
            'type' => 'text',
            'title' => 'Email'
        ),
        'user_id' => array(
            'title' => 'User name, User email',
            'relationship' => 'users',
            'select' => "CONCAT((:table).first_name, ' ',(:table).last_name, ',',(:table).email)"
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