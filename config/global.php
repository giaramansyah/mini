<?php
return [
    //static menu
    'menu' => [
        'home' => 'Home',
    ],

    //static privilege
    'privilege' => [
        'id' => [
            'login' => 1001,
            'logout' => 1010,
            'register' => 1011,
            'newpswd' => 1009,
            'modifypswd' => 1090,
            'forgetpswd' => 1900,
            'resendpswd' => 1909,
            'download' => 2001,
            'upload' => 2002,
            'api' => 9009,
            'unknown' => 9999,
        ],
        'code' => [
            'login' => 'AUTH',
            'logout' => 'LOUT',
            'register' => 'RGTR',
            'newpswd' => 'NPWD',
            'modifypswd' => 'MPWD',
            'forgetpswd' => 'FPWD',
            'resendpswd' => 'RPWD',
            'download' => 'DWLD',
            'upload' => 'UPLD',
            'api' => 'APIR',
            'unknown' => 'UKWN',
        ],
        'desc' => [
            'login' => 'Login to app',
            'logout' => 'Logout from app',
            'register' => 'Register to app',
            'newpswd' => 'Create new password',
            'modifypswd' => 'Modify password',
            'forgetpswd' => 'Forget password',
            'resendpswd' => 'Resend Password',
            'download' => 'Download File',
            'upload' => 'Upload File',
            'api' => 'API Request',
            'unknown' => 'Unknown Entities',
        ]
    ],

    //static months
    'month' => [
        'code' => [
            'jan' => '01',
            'feb' => '02',
            'mar' => '03',
            'apr' => '04',
            'may' => '05',
            'jun' => '06',
            'jul' => '07',
            'aug' => '08',
            'sep' => '09',
            'oct' => '10',
            'nov' => '11',
            'dec' => '12',
        ],
        'desc' => [
            'jan' => 'label.month.jan',
            'feb' => 'label.month.feb',
            'mar' => 'label.month.mar',
            'apr' => 'label.month.apr',
            'may' => 'label.month.may',
            'jun' => 'label.month.jun',
            'jul' => 'label.month.jul',
            'aug' => 'label.month.aug',
            'sep' => 'label.month.sep',
            'oct' => 'label.month.oct',
            'nov' => 'label.month.nov',
            'dec' => 'label.month.dec',
        ],
        'static' => [
            'jan' => 'january',
            'feb' => 'february',
            'mar' => 'march',
            'apr' => 'april',
            'may' => 'may',
            'jun' => 'june',
            'jul' => 'july',
            'aug' => 'august',
            'sep' => 'september',
            'oct' => 'october',
            'nov' => 'november',
            'dec' => 'december',
        ]
    ],

    //static days
    'days' => [
        'code' => [
            'mon' => 1,
            'tue' => 2,
            'wed' => 3,
            'thu' => 4,
            'fri' => 5,
            'sat' => 6,
            'sun' => 7,
        ],
        'desc' => [
            'mon' => 'label.day.mon',
            'tue' => 'label.day.tue',
            'wed' => 'label.day.wed',
            'thu' => 'label.day.thu',
            'fri' => 'label.day.fri',
            'sat' => 'label.day.sat',
            'sun' => 'label.day.sun',
        ],
    ],

    //alert code
    'alert' => [
        'error',
        'success',
        'warning',
        'info'
    ],

    //dataflow modules
    'modules' => [
        'code' => [
            'create' => 1,
            'update' => 2,
            'delete' => 3,
            'readall' => 4,
            'readid' => 5,
        ],
        'desc' => [
            'create' => 'label.module.create',
            'update' => 'label.module.update',
            'delete' => 'label.module.delete',
            'readall' => 'label.module.readall',
            'readid' => 'label.module.readid',
        ]

    ],

    //hidden accounts
    'accounts' => [
        'system',
        'sysadmin'
    ],

    //hidden privilege groups
    'privilege_group' => [
        'SUPERSU'
    ],

    //hidden menu
    'menu' => [
        'privilege'
    ],

    //date format
    'dateformat' => [
        'view' => 'd M Y H:i:s',
        'viewdate' => 'd M Y',
        'date' => 'Y-m-d',
        'time' => 'H:i:s',
        'datetime' => 'Y-m-d H:i:s',
    ],

    //language
    'languages' => [
        'code' => [
            'english' => 'en',
            'indonesia' => 'id'
        ],
        'desc' => [
            'english' => 'English',
            'indonesia' => 'Bahasa Indonesia'
        ],
    ],

    //static action parameter
    'action' => [
        'form' => [
            'add' => 'new',
            'edit' => 'modify',
            'delete' => 'remove',
            'able' => 'able',
            'lock' => 'lock',
            'logout' => 'out',
        ],
        'password' => [
            'add' => 'new',
            'edit' => 'modify',
            'forget' => 'forget',
            'resend' => 'request',
        ]
    ],

    //static ccy parameter
    'ccy' => [
        'idr' => 'Rp',
        'usd' => '$',
    ],
];
