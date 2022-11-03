<?php

return [
    'service' => [
        'client_id' => env('LINEAR_CLIENT_ID'),
        'client_secret' => env('LINEAR_CLIENT_SECRET'),
        'redirect' => env('LINEAR_REDIRECT_URI', '/linear/oauth2/callback'),
    ],
];
