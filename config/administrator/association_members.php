<?php
return array(
    'title' => 'Association members',
    'single' => 'Association member',
    'model' => 'Modules\Association\Repositories\Entities\AssociationModel',
    'columns' => array(
        'id' => array(
            'type' => 'text',
            'title' => 'id'
        ),
        'seller_id' => array(
            'title' => 'Member name, Member lastname, Member email',
            'relationship' => 'user',
            'select' => "COUNT((:table).id)"
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