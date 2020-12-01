<?php

return [
    'name' => 'CRM',
    'config' => [
		'customer' => [
			'type' => 'type-customer',
			'group' => 'group-customer',
            'kind' => 'kind-customer'
		],
        'activity' => [
            'type' => 'type-activity',
            'group' => 'group-activity',
            'kind' => 'kind-activity'
        ],
        'sale' => [
            'kind' => 'kind-sale'
        ],
        'marketing' => [
            'type' => 'type-marketing',
            'group' => 'group-marketing',
            'kind' => 'kind-marketing'
        ],
        'common' => [
            'relation' => 'crm-relation',
            'business' => 'crm-business',
            'department' => 'crm-department',
            'position' => 'crm-position',
            'market' => 'crm-market',
            'channel' => 'crm-channel'
        ],
    ]
];
