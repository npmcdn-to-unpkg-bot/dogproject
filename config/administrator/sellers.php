<?php
return array(
    'title' => 'Sellers',
    'single' => 'Seller',
    'model' => 'Modules\Seller\Repositories\Entities\SellerModel',
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
        'type' => array(
            'type' => 'text',
            'title' => 'type'
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
        'address' => array(
            'type' => 'text',
            'title' => 'address'
        ),
        'photo' => array(
            'type' => 'text',
            'title' => 'photo'
        ),
        'language' => array(
            'type' => 'text',
            'title' => 'language'
        ),
        'find_out' => array(
            'type' => 'text',
            'title' => 'find_out'
        ),
        'about' => array(
            'type' => 'text',
            'title' => 'about'
        ),
        'newsletter' => array(
            'title' => 'newsletter',
            'type' => 'boolean'
        ),
        'terms' => array(
            'type' => 'bool',
            'title' => 'terms'
        ),
        'smartphone' => array(
            'type' => 'bool',
            'title' => 'smartphone'
        ),
        'verified' => array(
            'type' => 'bool',
            'title' => 'verified'
        ),
        'suspicious' => array(
            'type' => 'bool',
            'title' => 'suspicious'
        ),
        'slug' => array(
            'type' => 'text',
            'title' => 'slug'
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