<?php

use App\User;

return [
    'model' => User::class,
    'table' => 'oauth_identities',
    'providers' => [
        // 'facebook' => [
        //     'client_id' => '12345678',
        //     'client_secret' => 'y0ur53cr374ppk3y',
        //     'redirect_uri' => 'https://example.com/your/facebook/redirect',
        //     'scope' => [],
        // ],
        // 'google' => [
        //     'client_id' => '12345678',
        //     'client_secret' => 'y0ur53cr374ppk3y',
        //     'redirect_uri' => 'https://example.com/your/google/redirect',
        //     'scope' => [],
        // ],
        'github' => [
            'client_id' => 'a694d5eeef704f84272f',
            'client_secret' => '178b05f13405f67b274bd07cbab7f234979ba673',
            'redirect_uri' => 'http://localhost:3000/github/login',
            'scope' => [],
        ],
        // 'linkedin' => [
        //     'client_id' => '12345678',
        //     'client_secret' => 'y0ur53cr374ppk3y',
        //     'redirect_uri' => 'https://example.com/your/linkedin/redirect',
        //     'scope' => [],
        // ],
        // 'instagram' => [
        //     'client_id' => '12345678',
        //     'client_secret' => 'y0ur53cr374ppk3y',
        //     'redirect_uri' => 'https://example.com/your/instagram/redirect',
        //     'scope' => [],
        // ],
        // 'soundcloud' => [
        //     'client_id' => '12345678',
        //     'client_secret' => 'y0ur53cr374ppk3y',
        //     'redirect_uri' => 'https://example.com/your/soundcloud/redirect',
        //     'scope' => [],
        // ],
    ],
];
