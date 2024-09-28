<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI'),
        'stateless' => true,
    ],
    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect' => env('GITHUB_REDIRECT_URI'),
        'scopes' => [
            'read:user',
        ],
    ],

];

/* Laravel\Socialite\Two\User Object ( 
    [id] => 101486030426145466244 
    [nickname] => 
    [name] => David Mendoza Flores 
    [email] => mendozaf.david@gmail.com 
    [avatar] => https://lh3.googleusercontent.com/a/ACg8ocIb9YJ-x61EphvVJo1IEL7KraLZHfU99DwOCfwWMdHgLISzh-nd=s96-c 
    [user] => Array ( 
        [sub] => 101486030426145466244 
        [name] => David Mendoza Flores 
        [given_name] => David 
        [family_name] => Mendoza Flores 
        [picture] => https://lh3.googleusercontent.com/a/ACg8ocIb9YJ-x61EphvVJo1IEL7KraLZHfU99DwOCfwWMdHgLISzh-nd=s96-c 
        [email] => mendozaf.david@gmail.com 
        [email_verified] => 1 
        [id] => 101486030426145466244 
        [verified_email] => 1 
        [link] => ) 
    [attributes] => Array ( 
        [id] => 101486030426145466244 
        [nickname] => 
        [name] => David Mendoza Flores 
        [email] => mendozaf.david@gmail.com 
        [avatar] => https://lh3.googleusercontent.com/a/ACg8ocIb9YJ-x61EphvVJo1IEL7KraLZHfU99DwOCfwWMdHgLISzh-nd=s96-c 
        [avatar_original] => https://lh3.googleusercontent.com/a/ACg8ocIb9YJ-x61EphvVJo1IEL7KraLZHfU99DwOCfwWMdHgLISzh-nd=s96-c ) 
        [token] => ya29.a0AXooCgtdHstrJ05l2ibBT_OucUwX1w6vOWYT-dRMQTgQI4hmZVMakiz4CFr3mobz-RG7yw74F82lizQo9ljM4VGVnNFJpNkirwL9o7m7CM0sFuTf5tqyzVC1n3IL-Qz86-YOhesrosnTtZeRu_LlRP2lR4607OxYcAaCgYKAc0SARMSFQHGX2MiGk5rYaD0-b7wkQqdCx1eqA0169 
        [refreshToken] => 
        [expiresIn] => 3599 
        [approvedScopes] => Array ( 
            [0] => https://www.googleapis.com/auth/userinfo.profile 
            [1] => https://www.googleapis.com/auth/userinfo.email 
            [2] => openid 
            ) 
        ) */