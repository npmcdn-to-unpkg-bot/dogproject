<?php
return array(
    'title' => 'Verifications',
    'single' => 'Verification',
    'model' => 'Modules\Seller\Repositories\Entities\SellerVerificationModel',
    'columns' => array(
        'id' => array(
            'type' => 'text',
            'title' => 'id'
        ),
        'seller_id' => array(
            'title' => 'Seller name, Seller email',
            'relationship' => 'seller.users',
            'select' => "CONCAT((:table).first_name, ' ', (:table).last_name, ',', (:table).email)"
        ),
        'type' => array(
            'type' => 'enum',
            'title' => 'Type',
            'options' => array('1', '2')
        ),
        'number' => array(
            'type' => 'int',
            'title' => 'Number'
        ),
        'status' => array(
            'type' => 'text',
            'title' => 'Status'
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