<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Mail\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Mail\Message;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as HtmlPart;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class MimeMessageFactory
 * @package MSBios\Mail\Factory
 */
class MimeMessageFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return Message|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var HtmlPart $htmlPart */
        $htmlPart = $container->build('HtmlPart', $options);

        /** @var MimeMessage $body */
        $body = new MimeMessage;
        $body->addPart($htmlPart);

        return $body;
    }
}
