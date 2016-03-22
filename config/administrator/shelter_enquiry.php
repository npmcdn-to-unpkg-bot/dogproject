<?php
return array(
    'title' => 'Enquiries',
    'single' => 'Enquiry',
    'model' => 'Modules\Shelter\Repositories\Entities\ShelterDogEnquiryModel',
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
        'dog_id' => array(
            'title' => 'Dog breed',
            'relationship' => 'dogs',
            'select' => "CONCAT((:table).breed_id, ',', (:table).about)"
        ),

        'name' => array(
            'type' => 'text',
            'title' => 'Name'
        ),
        'email' => array(
            'type' => 'text',
            'title' => 'Email'
        ),
        'contact_number' => array(
            'type' => 'text',
            'title' => 'Contact number"'
        ),
        'enquiry' => array(
            'type' => 'text',
            'title' => 'Enquiry'
        ),
        'review_token' => array(
            'type' => 'text',
            'title' => 'Review token'
        ),
        'reviewed' => array(
            'type' => 'bool',
            'title' => 'Reviewes'
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