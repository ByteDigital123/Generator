<?php

return [

    // the models that we
    // dont want to generate
    // files for
    'legacyModels' => [
        'Address',
        'AdminUser',
        'Blog',
        'ContactForm',
        'Content',
        'ContentType',
        'Country',
        'EmailVerification',
        'ModelHasPermission',
        'ModelHasRole',
        'Page',
        'Permission',
        'PermissionGroup',
        'Role',
        'Transaction',
        'TransactionStatus',
        'User',
        'OauthAccessToken',
        'Sandbox',
        'BaseModel',
    ],

    // the namepsaces where
    // we are going to generate
    // the files for
    "areas" => [
        'Api',
        'Website',
        'UserDashboard',
    ],

    // where the models live
    "models" => 'app/Models',

];
