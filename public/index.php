<?php

use Zend\Mvc\Application;
use Zend\Stdlib\ArrayUtils;

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (__FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}

// Composer autoloading
include __DIR__ . '/../vendor/autoload.php';

if (! class_exists(Application::class)) {
    throw new RuntimeException(
        "Unable to load application.\n"
        . "- Type `composer install` if you are developing locally.\n"
        . "- Type `vagrant ssh -c 'composer install'` if you are using Vagrant.\n"
        . "- Type `docker-compose run zf composer install` if you are using Docker.\n"
    );
}

// Retrieve configuration
$appConfig = require __DIR__ . '/../config/application.config.php';
if (file_exists(__DIR__ . '/../config/development.config.php')) {
    $appConfig = ArrayUtils::merge($appConfig, require __DIR__ . '/../config/development.config.php');
}

// Run the application!
$serviceManager = Application::init($appConfig)->getServiceManager();

/** @var \MSBios\Mail\Message $message */
$message = $serviceManager->get(\MSBios\Mail\Message::class);
$message
    ->addTo('judzhin@gns-it.com');
// ->setBody('Hello World')
// ->send();

/** @var \MSBios\Mail\Message $message */
$mime = $serviceManager->build('MimeMessage', [
    'variables' => [
        'content' => 'This is a really simple email template. Its sole purpose is to get the recipient to click the button with no distractions.',
        'footer' => 'Good luck! Hope it works.'
    ]
]);
$message
    ->setBody($mime)
    ->send();
