<?php

/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Mail;

use Zend\Mail\Transport\Smtp;

return [
    Module::class => [

        Message::class => [
            'from' => [
                'emailOrAddressList' => 'test.for.zend@gmail.com',
                'name' => 'Test For Zend'
            ],
            'subject' => 'Subject Test From Zend',
            // 'transport' => Smtp::class
        ],

        Smtp::class => [
            'name' => 'gmail.com',
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'connection_class' => 'login',
            'connection_config' => [
                'username' => 'test.for.zend@gmail.com',
                'password' => 'passTestForZend',
                'ssl' => 'tls',
            ]
        ]
    ]
];
