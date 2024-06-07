<?php
return [
    'error' => [
        '404' => 'Bad Request',
        '401' => 'Sorry, You are not authorized for this action',
    ],

    'success' => [
        'connect' => 'Success'
    ],

    'login' => [
        'welcome' => 'Welcome, :name',
        'invalid' => 'Invalid credentials',
        'disabled' => 'Account has been disabled. Contact your administrator',
        'unregister' => 'Account not registered',
        'locked' => 'Account has been locked. Contact your administrator',
        'logged' => 'Account is logged in other device',
    ],

    'password' => [
        'data' => [
            'failed' => 'Account data not found',
        ],
        'add' => [
            'success' => 'New password created successfully',
            'failed' => 'New password create failed. Please try again',
        ],
        'edit' => [
            'success' => 'Password updated successfully',
            'failed' => 'Password update failed. Please try again',
            'invalid' => 'Current password is invalid. Please try again',
        ],
        'resend' => [
            'success' => 'Password reset link successfully sent to account email',
            'failed' => 'Password reset link send failed. Please try again',
            'hasty' => 'Password reset link has been sent while ago. Please wait for another 6 hours',
        ],
        'forget' => [
            'success' => 'Password reset link successfully sent to your account email',
            'failed' => 'Password reset link send failed. Please try again',
        ],
    ],

    'privilege' => [
        'data' => [
            'success' => 'Privilege data found',
            'failed' => 'Privilege data not found',
        ],
        'add' => [
            'success' => 'Privilege created successfully',
            'failed' => 'Privilege create failed. Please try again',
            'exist' => 'Privilege code already exist',
        ],
        'edit' => [
            'success' => 'Privilege updated successfully',
            'failed' => 'Privilege update failed. Please try again',
        ],
        'delete' => [
            'success' => 'Privilege deleted successfully',
            'failed' => 'Privilege delete failed. Please try again',
        ],
    ],

    'privigroup' => [
        'data' => [
            'success' => 'Privilege group data found',
            'failed' => 'Privilege group data not found',
        ],
        'add' => [
            'success' => 'Privilege group created successfully',
            'failed' => 'Privilege group create failed. Please try again',
            'exist' => 'Privilege group name already exist',
        ],
        'edit' => [
            'success' => 'Privilege group updated successfully',
            'failed' => 'Privilege group update failed. Please try again',
        ],
        'delete' => [
            'success' => 'Privilege group deleted successfully',
            'failed' => 'Privilege group delete failed. Please try again',
        ],
    ],

    'account' => [
        'data' => [
            'success' => 'Account data found',
            'failed' => 'Account data not found',
        ],
        'add' => [
            'success' => 'Account created successfully',
            'failed' => 'Account create failed. Please try again',
            'exist' => 'Account code already exist',
        ],
        'edit' => [
            'success' => 'Account updated successfully',
            'failed' => 'Account update failed. Please try again',
        ],
        'delete' => [
            'success' => 'Account deleted successfully',
            'failed' => 'Account delete failed. Please try again',
        ],
        'active' => [
            'activate' => 'Account activated successfully',
            'deactivate' => 'Account deactivated successfully',
            'failed' => 'Account activation failed. Please try again',
        ],
        'lock' => [
            'locked' => 'Account locked successfully',
            'unlocked' => 'Account unlocked successfully',
            'failed' => 'Account lock failed. Please try again',
        ],
        'logout' => [
            'success' => 'Account logged out successfully',
            'failed' => 'Account logout failed. Please try again',
        ],
    ],

    'log' => [
        'data' => [
            'success' => 'Account log data found',
            'failed' => 'Account log not found',
        ],
    ],

    'general' => [
        'api' => [
            'success' =>'API key succesfuly generated'
        ],
        'edit' => [
            'success' => 'General setting updated successfully',
            'failed' => 'General setting update failed. Please try again',
        ],
    ],

    'upload' => [
        'file' => [
            'success' => 'File successfuly uploaded',
            'failed' => 'File upload failed. Please try again.',
            'column' => 'File rejected, columns format is invalid in sheet :name',
            'column' => 'File rejected, weather data in manadatory or invalid data type, sheet :name; row :row; column :column',
        ],
    ],
];
