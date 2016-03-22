<?php
return array(
    'title' => 'Reviews',
    'single' => 'Review',
    'model' => 'Modules\SellerComments\Repositories\Entities\SellerCommentsModel',
    'columns' => array(
        'id' => array(
            'type' => 'text',
            'title' => 'id'
        ),
        'user_id' => array(
            'title' => 'Seller name, Seller email',
            'relationship' => 'seller.users',
            'select' => "CONCAT((:table).first_name, ' ', (:table).last_name, ',', (:table).email)"
        ),
        'rating1' => array(
            'type' => 'int',
            'title' => 'Rating1'
        ),
        'rating2' => array(
            'type' => 'int',
            'title' => 'Rating"'
        ),
        'rating3' => array(
            'type' => 'int',
            'title' => 'Rating3'
        ),
        'rating4' => array(
            'type' => 'int',
            'title' => 'Rating4'
        ),
        'rating5' => array(
            'type' => 'int',
            'title' => 'Rating5'
        ),
        'name' => array(
            'type' => 'int',
            'title' => 'Name'
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
        'about' => array(
            'type' => 'int',
            'title' => 'About'
        ),
        'contact_number' => array(
            'type' => 'text',
            'title' => 'Contact number'
        ),
        'approved' => array(
            'type' => 'bool',
            'title' => 'Approved'
        ),
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