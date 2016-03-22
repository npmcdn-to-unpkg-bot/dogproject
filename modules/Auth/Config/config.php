<?php

return [
    'name' => 'Auth',
    'model' => [
        'relations' => [
            'auth' => ['seller','association','seller_enquiry']
        ],
        'pivots' => [
            'auth' => [
                'seller' => ['seller.suburb','seller.state','seller.verification','seller.dogs','seller.review']
            ]
        ],
    ]
];