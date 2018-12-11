<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Mail;

use MSBios\Factory\ModuleFactory;
use Zend\Mail\Transport\Smtp;

return [
    'service_manager' => [
        'factories' => [
            Module::class =>
                ModuleFactory::class,
            Message::class =>
                Factory\MessageFactory::class,

            // transport
            Smtp::class =>
                Factory\SmtpTransportFactory::class
        ],
    ],

    Module::class => [

        /**
         * Message.
         *
         * Expects: array
         */
        Message::class => [

            /**
             * From.
             *
             * Expects: array
             * Default: [
             *     'emailOrAddressList' => null,
             *     'name' => null
             * ]
             */
            'from' => [

                /**
                 * Address List.
                 *
                 * Expects: string|Address\AddressInterface|array|AddressList|Traversable
                 * Default: null
                 */
                'emailOrAddressList' => null,

                /**
                 * Name.
                 *
                 * Expects: string
                 * Default: null
                 */
                'name' => null
            ],

            /**
             * Subject.
             *
             * Expects: string
             * Default: null
             */
            'subject' => null,

            /**
             * Transport
             *
             * Expects: string
             * Default: Zend\Mail\Transport\Smtp
             */
            'transport' => Smtp::class
        ],

        /**
         * Transport.
         *
         * Expects: array
         */
        Smtp::class => [

            /**
             * Name.
             *
             * Expects: string
             * Default: 'gmail.com'
             */
            'name' => 'gmail.com',

            /**
             * Host.
             *
             * Expects: string
             * Default: 'smtp.gmail.com'
             */
            'host' => 'smtp.gmail.com',

            /**
             * Port.
             *
             * Expects: number
             * Default: 587
             */
            'port' => 587,

            /**
             * Connection Class.
             *
             * Expects: string
             * Default: 'login'
             */
            'connection_class' => 'login',

            /**
             * Connection Config.
             *
             * Expects: array
             */
            'connection_config' => [

                /**
                 * Username.
                 *
                 * Expects: string
                 * Default: 'test.for.zend@gmail.com'
                 */
                'username' => 'test.for.zend@gmail.com',

                /**
                 * Password.
                 *
                 * Expects: string
                 * Default: 'passTestForZend'
                 */
                'password' => 'passTestForZend',

                /**
                 * SSL.
                 *
                 * Expects: string
                 * Default: 'tls'
                 */
                'ssl' => 'tls',
            ]
        ]
    ],

];
