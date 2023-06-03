<?php

return [
    'base_url'    => env('FINNOTECH_BASE_URL', 'https://apibeta.finnotech.ir'),
    'credentials' => [
        'username' => env('FINNOTECH_APPLICATION_ID'),
        'password' => env('FINNOTECH_PASSWORD'),
        'nid'      => env('FINNOTECH_NID'),
        'scopes'   => [
            "facility:shahkar:get",
            "oak:iban-inquiry:get",
        ]
    ],
    'prefixes'    => [
        'dev'      => '/dev/v2',
        'facility' => '/facility/v2',
        'oak'      => '/oak/v2',
        'clients'  => '/clients/'
    ],
    'endpoints'   => [
        'request_token'  => '/oauth2/token',
        'shahkar_verify' => '/shahkar/verify',
        'iban_inquiry'   => '/ibanInquiry',
    ],
];
