<?php

use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Mime;
use Zend\Mime\Part as MimePart;
use Zend\Mail\Transport\SmtpOptions;

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
include __DIR__ . '/vendor/autoload.php';

if (!class_exists(Message::class)) {
    throw new RuntimeException(
        "Unable to load application.\n"
        . "- Type `composer install` if you are developing locally.\n"
        . "- Type `vagrant ssh -c 'composer install'` if you are using Vagrant.\n"
        . "- Type `docker-compose run zf composer install` if you are using Docker.\n"
    );
}

///** @var string $htmlMarkup */
//$htmlMarkup = file_get_contents(__DIR__ . '/template.phtml');
//
///** @var \Zend\Mime\Part $html */
//// $html = new MimePart($htmlMarkup);
//$html = new MimePart($htmlMarkup);
//$html->type = Mime::TYPE_HTML;
//$html->charset = 'utf-8';
//$html->encoding = Mime::ENCODING_QUOTEDPRINTABLE;
//$html->disposition = Mime::DISPOSITION_INLINE;
//
///** @var \Zend\Mime\Message $body */
//$body = new MimeMessage;
//$body->addPart($html);

/** @var Message $message */
$message = new Message;
$message
    // ->setBody($body)
    ->setBody("Хватит спамить, сейчас всех забаним.")
    ->setFrom('bot@gns-it.com', 'GNS-IT Bot')
    // ->addTo('itea@itea.ua')
    ->addTo('all@gns-it.com')
    ->setSubject('inf - Congratulations!');

/** @var \Zend\Mail\Transport\TransportInterface $transport */
$transport = new SmtpTransport();

/** @var \Zend\Stdlib\ParameterObjectInterface $options */
$options = new SmtpOptions([
    'name' => 'gns-it.com',
    'host' => 'mail.gns-it.com',
    'port' => 25,
    'connection_class' => 'login',
    'connection_config' => [
        'username' => '',
        'password' => '',
        'ssl' => 'tls',
    ]
]);

$transport->setOptions($options);
$transport->send($message);