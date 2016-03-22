<?php
return array(
    'title' => 'Associations',
    'single' => 'Association',
    'model' => 'Modules\Association\Repositories\Entities\AssociationModel',
    'columns' => array(
        'id' => array(
            'type' => 'text',
            'title' => 'id'
        ),
        'user_id' => array(
            'title' => 'user_name, user_lastname, user_email, user_password',
            'relationship' => 'users',
            'select' => "CONCAT((:table).first_name, ',', (:table).last_name, ',', (:table).email, ',', (:table).password)"
        ),
        'name' => array(
            'type' => 'text',
            'title' => 'Name'
        ),
        'suburb_id' => array(
            'title' => 'suburb',
            'relationship' => 'suburb',
            'select' => "(:table).suburb"
        ),
        'state_id' => array(
            'title' => 'state',
            'relationship' => 'state',
            'select' => "(:table).name"
        ),
        'avatar' => array(
            'type' => 'text',
            'title' => 'Avatar'
        ),

        'about' => array(
            'type' => 'text',
            'title' => 'About'
        ),
        'banner_image' => array(
            'type' => 'text',
            'title' => 'Banner image'
        ),
        'website' => array(
            'type' => 'text',
            'title' => 'Website'
        ),
        'slug' => array(
            'type' => 'text',
            'title' => 'slug'
        )
    ),
    'edit_fields' => array(
        'users' => array(
            'type' => 'relationship',
            'title' => 'User',
            'name_field' => 'id',
        ),
        'name' => array(
            'type' => 'text',
            'title' => 'name'
        ),
        'suburb' => array(
            'type' => 'relationship',
            'title' => 'Suburb',
            'name_field' => 'id',
        ),
        'avatar' => array(
            'type' => 'text',
            'title' => 'avatar'
        ),
        'about' => array(
            'type' => 'text',
            'title' => 'about'
        ),
        'website' => array(
            'type' => 'text',
            'title' => 'website'
        ),
        'slug' => array(
            'type' => 'text',
            'title' => 'slug'
        )
    ),
);