<?php
return array(
    'title' => 'Hobby Verifications',
    'single' => 'Hobby Verification',
    'model' => 'Modules\Seller\Repositories\Entities\SellerHobbyVerificationModel',
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
        'question1' => array(
            'type' => 'bool',
            'title' => 'Question1'
        ),
        'question2' => array(
            'type' => 'bool',
            'title' => 'Question2'
        ),
        'question3' => array(
            'type' => 'bool',
            'title' => 'Question3'
        ),
        'question4' => array(
            'type' => 'bool',
            'title' => 'Question4'
        ),
        'question5' => array(
            'type' => 'bool',
            'title' => 'Question5'
        ),
        'question6' => array(
            'type' => 'bool',
            'title' => 'Question6'
        ),
        'question7' => array(
            'type' => 'bool',
            'title' => 'Question7'
        ),
        'question8' => array(
            'type' => 'bool',
            'title' => 'Question8'
        ),
        'question9' => array(
            'type' => 'bool',
            'title' => 'Question9'
        ),
        'question10' => array(
            'type' => 'bool',
            'title' => 'Question10'
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
            'type' => 'bool',
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