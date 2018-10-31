<?php

return [
    'name' => 'gmail.com',
    'host' => 'smtp.gmail.com',
    'port' => 587,
    'connection_class' => 'login',
    'connection_config' => [
        'username' => 'test.for.zend@gmail.com',
        'password' => 'passTestForZend',
        'ssl' => 'tls',
    ]
];