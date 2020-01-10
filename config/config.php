<?php

return [

    // the models that we
    // dont want to generate
    // files for
    'legacyModels' => [
        'AdminUser',
        'Permission',
        'FileModel',
        'OauthAccessToken',
        'Page',
        'Role',
        'Sandbox',
        'User',
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
