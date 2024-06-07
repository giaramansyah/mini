<?php
return [
    'navigation' => [
        'home' => 'Home',
        'account' => 'My Account',
        'logout' => 'Logout',
        'password' => 'Change Password',
        'parent_menu' => [
            'setting' => 'Setting',
            'applog' => 'Application Log',
            'account' => 'Profile',
            'master' => 'Master',
        ],
        'menu' => [
            'privilege' => 'Privilege',
            'privigroup' => 'Privilege Group',
            'account' => 'Account',
            'accactivity' => 'Account Activity',
            'mailtrail' => 'Mail Trail',
            'apitrail' => 'API Trail',
            'profile' => 'My Account',
            'general' => 'General',
            'upload' => 'Upload',
            'transaction' => 'Transaction',
            'sales' => 'Sales',
            'product' => 'Product',
            'ticket' => 'Ticket',
        ],
    ],

    'month' => [
        'jan' => 'January',
        'feb' => 'February',
        'mar' => 'March',
        'apr' => 'April',
        'may' => 'May',
        'jun' => 'June',
        'jul' => 'July',
        'aug' => 'August',
        'sep' => 'September',
        'oct' => 'October',
        'nov' => 'November',
        'dec' => 'December',
    ],

    'day' => [
        'mon' => 'Monday',
        'tue' => 'Tuesday',
        'wed' => 'Wednesday',
        'thu' => 'Thursday',
        'fri' => 'Friday',
        'sat' => 'Saturday',
        'sun' => 'Sunday',
    ],

    'static' => [
        'select_option' => 'Select item',
        'empty_table' => 'No Data Found',
        'file' => 'Choose File',
    ],

    'module' => [
        'create' => 'Create Data',
        'update' => 'Update Data',
        'delete' => 'Remove Data',
        'readall' => 'Read List Data',
        'readid' => 'Read Detail Data',
    ],

    'button' => [
        'add' => 'Add new',
        'edit' => 'Update',
        'delete' => 'Remove',
        'submit' => 'Submit',
        'back' => 'Back',
        'proceed' => 'Proceed',
        'cancel' => 'Cancel',
        'resetpass' => 'Resend Password',
        'deactive' => 'Deactive',
        'active' => 'Activate',
        'lock' => 'Lock Account',
        'unlock' => 'Unlock Account',
        'logout' => 'Force Logout',
        'changepass' => 'Change Password',
        'file' => 'Choose File',
    ],

    'footer' => [
        'version' => 'Version'
    ],

    '404' => [
        'name' => '404 Not Found',
        'title' => 'Oops! Page not found.',
        'message' => 'We could not find the page you were looking for. Meanwhile, you may return to homepage',
        'return' => 'Return to Homepage',
    ],

    '401' => [
        'name' => '401 Unauthorized',
        'title' => 'Oops! Unauthorized page.',
        'message' => 'You don\'t have the permission to access this page. Meanwhile, you may return to homepage or contact your system administrator.',
        'return' => 'Return to Homepage',
    ],

    '406' => [
        'name' => '406 Expired Link',
        'title' => 'Oops! Link is expired.',
        'message' => 'The link you visit is no longer available. Meanwhile, you may return to homepage or contact your system administrator.',
        'return' => 'Return to Homepage',
    ],

    'modal' => [
        'delete' => [
            'title' => 'Are you sure want to delete this data ?'
        ],
        'forcelogout' => [
            'title' => 'Are you sure want to force logout this account ?'
        ],
        'resetpass' => [
            'title' => 'Are you sure want to resend password this account ?'
        ],
        'lock' => [
            'title' => 'Are you sure want to lock this data ?'
        ],
        'unlock' => [
            'title' => 'Are you sure want to unlock this data ?'
        ],
        'active' => [
            'title' => 'Are you sure want to activate this data ?'
        ],
        'deactive' => [
            'title' => 'Are you sure want to deactivate this data ?'
        ],
        'auth' => [
            'title' => 'Authentication'
        ],
    ],

    'login' => [
        'login' => 'Login',
        'register' => 'Register',
        'username' => 'Username',
        'password' => 'Password',
        'remember' => 'Remember Me',
        'title' => 'Sign in to start your session',
        'forget' => 'Forget Password',
    ],

    'register' => [
        'new' => 'Register',
        'title' => 'Register new account',
        'login' => 'Already have account? Login here',
        'username' => 'Username',
        'first_name' => 'First Name',
        'last_name' => 'Last Name (Optional)',
        'email' => 'Email',
    ],

    'password' => [
        'new' => 'Create Password',
        'new_message' => 'Create your new account password',
        'forget' => 'Forget Password',
        'forget_message' => 'Enter your username and email information. We\'ll send you reset password link to your email.',
        'username' => 'Username',
        'email' => 'email',
        'current' => 'Current Password',
        'password' => 'New Password',
        'retype' => 'Re-type Password',
        'login' => 'Login',
        'tooltip' => [
            'current' => 'Your current account password.',
            'password' => 'Your new account password.',
            'retype' => 'Re-type your new account password.',
        ]
    ],

    'privilege' => [
        'table' => [
            'no' => 'No',
            'code' => 'Code',
            'menu' => 'Menu',
            'modules' => 'Module',
            'description' => 'Description',
            'action' => 'Action',
        ],
        'form' => [
            'code' => 'Code',
            'menu' => 'Menu',
            'modules' => 'Module',
            'description' => 'Description',
        ],
        'tooltip' => [
            'code' => 'Unique alphanumeric for privilege identifier. Maximum 4 characters.',
            'menu' => 'Menu that associate with current privilege.',
            'modules' => 'Module that associate with current privilege.',
            'description' => 'Description of the current privilege.',
        ]
    ],

    'privigroup' => [
        'table' => [
            'no' => 'No',
            'name' => 'Group Name',
            'description' => 'Description',
            'updated_at' => 'Last Updated',
            'action' => 'Action',
            'modules' => 'Modules'
        ],
        'form' => [
            'name' => 'Group Name',
            'description' => 'Description',
            'privilege' => 'Privileges',
        ],
        'tooltip' => [
            'name' => 'Privilege group name.',
            'description' => 'Description of the current group.',
            'privilege' => 'Privilege that associate with current group.',
        ]
    ],

    'account' => [
        'table' => [
            'no' => 'No',
            'account' => 'Account',
            'email' => 'Email',
            'status' => 'Status',
            'last_login' => 'Last Logged In',
            'updated_at' => 'Last Updated',
            'action' => 'Action',
            'timestamp' => 'Timeline',
            'privilege' => 'Privilege',
            'description' => 'Description',
            'ip_address' => 'IP Address',
            'request' => 'UUID Request',
            'response' => 'UUID Response',
        ],
        'form' => [
            'username' => 'Username',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'privigroup' => 'Privilege Group',
            'cashier' => 'User as Cashier',
            'author' => 'User as Authorizer',
        ],
        'tooltip' => [
            'username' => 'The username used for the login account.',
            'first_name' => 'User account first name.',
            'last_name' => 'User account last name.',
            'email' => 'Active email of the user account.',
            'privigroup' => 'User account privilege Group.',
        ],
        'view' => [
            'email' => 'Email',
            'status' => 'Status',
            'last_login' => 'Last Logged In',
            'updated_by' => 'Last Updated',
            'privilege' => 'Privileges',
            'module' => 'Modules',
            'updated_at' => ':user On :date',
            'activity' => 'Account Activities',
            'last_activity' => 'Last 10 Activities',
            'new' => 'New Account',
            'active' => 'Active',
            'deactive' => 'Deactive',
            'lock' => 'Locked',
            'cashier' => 'User as Cashier',
            'author' => 'User as Authorizer',
        ]
    ],

    'accactivity' => [
        'table' => [
            'no' => 'No',
            'timestamp' => 'Timestamp',
            'username' => 'Account',
            'privilege' => 'Privilege',
            'description' => 'Description',
            'ip' => 'IP Address',
            'agent' => 'Device',
            'request' => 'UUID Request',
            'response' => 'UUID Response',
        ],
        'form' => [
            'date' => 'Date',
        ],
        'tooltip' => [
            'code' => 'The activity date is displayed.',
        ]
    ],

    'mailtrail' => [
        'table' => [
            'no' => 'No',
            'timestamp' => 'Timestamp',
            'agent' => 'Agent',
            'target' => 'Send To',
            'subject' => 'Subject',
            'response' => 'UUID Response',
        ],
        'form' => [
            'date' => 'Date',
        ],
        'tooltip' => [
            'code' => 'The log date is displayed.',
        ]
    ],

    'apitrail' => [
        'table' => [
            'no' => 'No',
            'timestamp' => 'Timestamp',
            'privilege' => 'Privilege',
            'description' => 'Description',
            'ip' => 'IP Address',
            'request' => 'UUID Request',
            'response' => 'UUID Response',
        ],
        'form' => [
            'date' => 'Date',
        ],
        'tooltip' => [
            'code' => 'The activity date is displayed.',
        ]
    ],

    'general' => [
        'form' => [
            'api' => 'API',
            'api_key' => 'API Key',
            'copied' => ':id copied successfully'
        ],
        'tooltip' => [
            'api_key' => 'API Key for third party app.',
        ]
    ],

    'upload' => [
        'form' => [
            'file' => 'File Upload',
        ],
        'tooltip' => [
            'file' => 'File upload only accpet extension .xlsx or .xls.',
        ]
    ],

    'transaction' => [
        'table' => [
            'invoice_no' => 'Invoice No.',
            'total_weight' => 'Total Weight',
            'shipping_fee_label' => 'Shipping Fee',
            'total_price_label' => 'Total Price',
            'shipping_date' => 'Shipping Date',
            'shipping_type' => 'Service',
            'transaction_date' => 'Transaction Date',
        ],
    ],

    'sales' => [
        'table' => [
            'invoice_no' => 'Invoice No.',
            'total_weight' => 'Total Weight',
            'shipping_fee_label' => 'Shipping Fee',
            'total_price_label' => 'Total Price',
            'total_sale_label' => 'Total Sale',
            'shipping_date' => 'Shipping Date',
            'shipping_type' => 'Service',
            'sales_date' => 'Sales Date',
            'product_id' => 'Product ID',
            'qty' => 'Qty',
            'weight' => 'Weight',
            'unit_price' => 'Unit Price',
            'discount' => 'Discount',
            'price' => 'Price',
        ],
        'view' => [
            'id' => 'Sales ID',
            'invoice_no' => 'Invoice No.',
            'total_weight' => 'Total Weight',
            'shipping_fee' => 'Shipping Fee',
            'total_price' => 'Total Price',
            'total_sale' => 'Total Sale',
            'shipping_date' => 'Shipping Date',
            'shipping_type' => 'Service',
            'sales_date' => 'Sales Date',
            'user_code' => 'User Code',
            'shipping_address' => 'Shipping Address',
            'expedition_id' => 'Expedtion ID',
            'sales_detail' => 'Sales Detail',
        ],
    ],

    'product' => [
        'table' => [
            'name' => 'Product',
            'weight' => 'Weight',
            'price_label' => 'Buy Price',
            'stock' => 'Stock',
            'sale_label' => 'Sale Price',
        ],
    ],

    'ticket' => [
        'table' => [
            'ticket_code' => 'Ticket ID',
            'ticket_date' => 'Date',
            'subject' => 'Subject',
            'issue' => 'Issue',
            'status' => 'Status',
            'user_id' => 'User ID',
            'update_date' => 'Updated Date',
        ],
        'view' => [
            'ticket_code' => 'Ticket ID',
            'ticket_date' => 'Date',
            'customer_id' => 'Customer ID',
            'product_id' => 'Product ID',
            'subject' => 'Subject',
            'issue' => 'Issue',
            'ticket_process' => 'Ticket Process',
        ],
    ],

];
