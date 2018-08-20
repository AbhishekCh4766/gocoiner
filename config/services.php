<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'twitter' => [
        'client_id' => 'Z7NoZjgPETvORx0DM9kd9pOLV',
        'client_secret' => 'uW0YcfJUcrfTRpo6gJY8IYd6h6sxWOLfKFjeGdNTi3ksi1fH7b',
        'redirect' => '/login/twitter/callback',
    ],

    'google' => [

        'client_id' => '621948252280-ckpk8s90hdlpcace15a02a72gggae94u.apps.googleusercontent.com',

        'client_secret' => 'cPKPU-D0zfX1IiGWi6WmoHSf',

        'redirect' => '/login/google/callback',

        ],

];
