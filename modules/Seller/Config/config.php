<?php

return [
    'name' => 'Seller',
    'model' => [
        'relations' => [
            'seller' => ['review','users','seller_enquiry','verification','suburb','state','dogs']
        ],
        'pivots' => [
            'seller' => [
                'review' => ['review.suburb','review.state'],
                'seller_enquiry' => ['seller_enquiry.dogs.breed','seller_enquiry.dogs.mother.breed','seller_enquiry.dogs.father.breed'],
                'verification' => ['verification','verification_hobby'],
                'dogs' => ['dogs.breed','dogs.mother.breed','dogs.father.breed'],
            ]
        ],
    ],
];