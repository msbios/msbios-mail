<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Mail\Factory;

use Interop\Container\ContainerInterface;
use Zend\Mime\Mime;
use Zend\Mime\Part;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class HtmlPartFactory
 * @package MSBios\Mail\Factory
 */
class HtmlPartFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return object|Part
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var string $htmlMarkup */
        $htmlMarkup = file_get_contents(__DIR__ . '/../../template.phtml');

        /** @var Part $part */
        $part = new Part($htmlMarkup);
        $part->type = Mime::TYPE_HTML;
        $part->charset = 'utf-8';
        $part->encoding = Mime::ENCODING_QUOTEDPRINTABLE;
        $part->disposition = Mime::DISPOSITION_INLINE;

        return $part;
    }
}
