<?php

return [
    'name' => 'Dog',
    'model' => [
        'relations' => [
            'dog' => ['owner','mother','father','breed','shelter','review']
        ],
        'pivots' => [
            'dog' => [
                'mother' => 'mother.breed',
                'father' => 'father.breed',
                'owner' => ['owner.suburb','owner.state','owner.users'],
                'review' => ['owner.review'],
                'shelter' => ['shelter.suburb','shelter.state','shelter.user']
            ]
        ],
    ],
];