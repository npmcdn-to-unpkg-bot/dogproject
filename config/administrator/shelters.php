<?php
return array(
    'title' => 'Shelters',
    'single' => 'Shelter',
    'model' => 'Modules\Shelter\Repositories\Entities\ShelterModel',
    'columns' => array(
        'id' => array(
            'type' => 'text',
            'title' => 'id'
        ),
        'user_id' => array(
            'title' => 'User name, User email, User password',
            'relationship' => 'user',
            'select' => "CONCAT((:table).first_name, ' ', (:table).last_name, ',', (:table).email, ',', (:table).password)"
        ),
        'name' => array(
            'type' => 'text',
            'title' => 'Name'
        ),
        'web_address' => array(
            'type' => 'text',
            'title' => 'Web address'
        ),
        'address' => array(
            'type' => 'text',
            'title' => 'Address'
        ),
        'suburb_id' => array(
            'title' => 'Suburb',
            'relationship' => 'suburb',
            'select' => "(:table).suburb"
        ),
        'state_id' => array(
            'title' => 'State',
            'relationship' => 'state',
            'select' => "(:table).name"
        ),
        'facebook' => array(
            'type' => 'text',
            'title' => 'Facebook'
        ),
        'twitter' => array(
            'type' => 'text',
            'title' => 'Twitter'
        ),
        'instagram' => array(
            'type' => 'text',
            'title' => 'Instagram'
        ),
        'about' => array(
            'type' => 'text',
            'title' => 'About'
        ),
        'avatar' => array(
            'type' => 'text',
            'title' => 'Avatar'
        ),
        'advert_photo' => array(
            'title' => 'Advert photo',
            'type' => 'txet'
        ),
        'slug' => array(
            'type' => 'text',
            'title' => 'slug'
        ),
        'terms' => array(
            'type' => 'bool',
            'title' => 'terms'
        ),
        'newsletter' => array(
            'type' => 'bool',
            'title' => 'Newsletter'
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