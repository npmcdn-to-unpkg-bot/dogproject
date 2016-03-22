<?php
return array(
    'title' => 'Enquiries',
    'single' => 'Enquiry',
    'model' => 'Modules\ShelterComments\Repositories\Entities\ShelterCommentsModel',
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
        'rating1' => array(
            'type' => 'int',
            'title' => 'Rating1'
        ),
        'rating2' => array(
            'type' => 'int',
            'title' => 'Rating2'
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
            'type' => 'text',
            'title' => 'Name'
        ),
        'about' => array(
            'type' => 'text',
            'title' => 'About'
        ),
        'contact_number' => array(
            'type' => 'text',
            'title' => 'Contact number"'
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