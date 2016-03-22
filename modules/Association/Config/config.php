<?php

return [
	'name' => 'Association',
    'model' => [
        'relations' => [
            'association' => ['breed','suburb','state','key_members','members','users']
        ],
        'pivots' => [
            'association' => [
                'members' => 'members.user'
            ]
        ],

    ],
];