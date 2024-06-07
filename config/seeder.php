<?php

return [
    //menus and privileges
    'parent_menus' => [
        [
            'label' => 'Setting',
            'alias' => 'setting',
            'icon' => 'fa-cog',
            'menus' => [
                [
                    'label' => 'General',
                    'alias' => 'general',
                    'url' => 'setting.general.index',
                    'privileges' => [
                        [
                            'code' => 'GRUP',
                            'modules' => 2,
                            'desc' => 'Update existing general setting data'
                        ],
                    ]
                ],
                [
                    'label' => 'Privilege',
                    'alias' => 'privilege',
                    'url' => 'setting.privilege.index',
                    'privileges' => [
                        [
                            'code' => 'PRCR',
                            'modules' => 1,
                            'desc' => 'Add new privilege data'
                        ],
                        [
                            'code' => 'PRUP',
                            'modules' => 2,
                            'desc' => 'Update existing privilege data'
                        ],
                        [
                            'code' => 'PRRM',
                            'modules' => 3,
                            'desc' => 'Remove existing privilege data'
                        ],
                        [
                            'code' => 'PRRA',
                            'modules' => 4,
                            'desc' => 'Read list of privilege data'
                        ],
                    ]
                ],
                [
                    'label' => 'Privilege Group',
                    'alias' => 'privigroup',
                    'url' => 'setting.privigroup.index',
                    'privileges' => [
                        [
                            'code' => 'PGCR',
                            'modules' => 1,
                            'desc' => 'Add new privilege group data'
                        ],
                        [
                            'code' => 'PGUP',
                            'modules' => 2,
                            'desc' => 'Update existing privilege group data'
                        ],
                        [
                            'code' => 'PGRM',
                            'modules' => 3,
                            'desc' => 'Remove existing privilege group data'
                        ],
                        [
                            'code' => 'PGRA',
                            'modules' => 4,
                            'desc' => 'Read list of privilege group data'
                        ],
                    ]
                ],
                [
                    'label' => 'Account',
                    'alias' => 'account',
                    'url' => 'setting.account.index',
                    'privileges' => [
                        [
                            'code' => 'ACCR',
                            'modules' => 1,
                            'desc' => 'Add new user account'
                        ],
                        [
                            'code' => 'ACUP',
                            'modules' => 2,
                            'desc' => 'Update existing user account'
                        ],
                        [
                            'code' => 'ACRM',
                            'modules' => 3,
                            'desc' => 'Remove existing user account'
                        ],
                        [
                            'code' => 'ACRA',
                            'modules' => 4,
                            'desc' => 'Read list of user account'
                        ],
                        [
                            'code' => 'ACRD',
                            'modules' => 5,
                            'desc' => 'Read detail of user account'
                        ],
                    ]
                ]
            ]
        ],
        [
            'label' => 'Application Log',
            'alias' => 'applog',
            'icon' => 'fa-keyboard',
            'menus' => [
                [
                    'label' => 'Account Activity',
                    'alias' => 'accactivity',
                    'url' => 'applog.accactivity.index',
                    'privileges' => [
                        [
                            'code' => 'AARA',
                            'modules' => 4,
                            'desc' => 'Read list of user account activity log'
                        ],
                    ]
                ],
                [
                    'label' => 'Mail Trail',
                    'alias' => 'mailtrail',
                    'url' => 'applog.mailtrail.index',
                    'privileges' => [
                        [
                            'code' => 'MLRA',
                            'modules' => 4,
                            'desc' => 'Read list of mailer log'
                        ],
                    ]
                ],
                [
                    'label' => 'API Trail',
                    'alias' => 'apitrail',
                    'url' => 'applog.apitrail.index',
                    'privileges' => [
                        [
                            'code' => 'ATRA',
                            'modules' => 4,
                            'desc' => 'Read list of api request log'
                        ],
                    ]
                ]
            ]
        ]
    ],

    //superuser account
    'accounts' => [
        'column' => [
            'id',
            'first_name',
            'last_name',
            'email',
            'username',
            'password',
            'hash',
            'is_new',
            'is_active',
            'is_trash',
            'is_author',
            'created_by',
            'updated_by',
            'privilege_group_id',
            'created_at',
            'updated_at',
        ],
        'data' => [
            [
                1,
                'System',
                'Admin',
                'sysadmin@laravel.app',
                'sysadmin',
                '$2y$10$jDOFyJFN68wCJSbsyZSAfedoP9d88U7aBPs0rEn3Ib4kCyjDAvdnS',
                '72a0d5ab745445acc798e65b2e67782b',
                0,
                1,
                0,
                1,
                0,
                0,
                1,
                Illuminate\Support\Carbon::now()->toDateTimeString(),
                Illuminate\Support\Carbon::now()->toDateTimeString(),
            ]
        ]
    ],

    //superuser privilege group
    'privilege_groups' => [
        'column' => [
            'id',
            'name',
            'description',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
        'data' => [
            [
                1,
                'SUPERSU',
                'Superuser Privilege',
                0,
                0,
                Illuminate\Support\Carbon::now()->toDateTimeString(),
                Illuminate\Support\Carbon::now()->toDateTimeString(),
            ],
            [
                2,
                'USER',
                'User Privilege',
                0,
                0,
                Illuminate\Support\Carbon::now()->toDateTimeString(),
                Illuminate\Support\Carbon::now()->toDateTimeString(),
            ]
        ]
    ],

    'privileges_map' => [
        'column' => [
            'privilege_group_id',
            'privilege_id',
        ],
        'data' => [
            [2, 1],
            [2, 2],
            [2, 3],
            [2, 4],
            [2, 5],
            [2, 6],
            [2, 7],
            [2, 22],
        ]
    ], 

    //modules
    'modules' => [
        [
            'label' => 'Master',
            'alias' => 'master',
            'icon' => 'fa-folder',
            'menus' => [
                [
                    'label' => 'Upload',
                    'alias' => 'upload',
                    'url' => 'master.upload.index',
                    'privileges' => [
                        [
                            'code' => 'UPCR',
                            'modules' => 1,
                            'desc' => 'Upload master data'
                        ],
                    ]
                ],
                [
                    'label' => 'Transaction',
                    'alias' => 'transaction',
                    'url' => 'master.transaction.index',
                    'privileges' => [
                        [
                            'code' => 'TRRA',
                            'modules' => 4,
                            'desc' => 'Read list of transaction data'
                        ],
                    ]
                ],
                [
                    'label' => 'Sales',
                    'alias' => 'sales',
                    'url' => 'master.sales.index',
                    'privileges' => [
                        [
                            'code' => 'SLRA',
                            'modules' => 4,
                            'desc' => 'Read list of sales data'
                        ],
                        [
                            'code' => 'SLRD',
                            'modules' => 5,
                            'desc' => 'Read detail of sales data'
                        ],
                    ]
                ],
                [
                    'label' => 'Product',
                    'alias' => 'product',
                    'url' => 'master.product.index',
                    'privileges' => [
                        [
                            'code' => 'PDRA',
                            'modules' => 4,
                            'desc' => 'Read list of product data'
                        ],
                    ]
                ],
                [
                    'label' => 'Ticket',
                    'alias' => 'ticket',
                    'url' => 'master.ticket.index',
                    'privileges' => [
                        [
                            'code' => 'TCRA',
                            'modules' => 4,
                            'desc' => 'Read list of ticket data'
                        ],
                        [
                            'code' => 'TCRD',
                            'modules' => 5,
                            'desc' => 'Read detail of ticket data'
                        ],
                    ]
                ],
            ]
        ],
    ],
];