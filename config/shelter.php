<?php

return [
    'name' => 'Shelter',
    'model' => [
        'relations' => [
            'shelter' => ['key_members','suburb','state','user','review','dogs','shelter_enquiry']
        ],
        'pivots' => [
            'shelter' => [
                'review' => ['review.suburb','review.state'],
                'dogs' => 'dogs.breed',
                'shelter_enquiry' => 'shelter_enquiry.dogs.breed'
            ]
        ],
    ],
];