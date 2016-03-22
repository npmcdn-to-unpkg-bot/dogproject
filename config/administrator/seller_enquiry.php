<?php
return array(
    'title' => 'Enquiries',
    'single' => 'Enquiry',
    'model' => 'Modules\Seller\Repositories\Entities\SellerEnquiryModel',
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
        'name' => array(
            'type' => 'text',
            'title' => 'Name'
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