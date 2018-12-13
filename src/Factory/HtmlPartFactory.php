<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Mail\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Mail\Module;
use MSBios\View\Renderer\PhpRenderer;
use Zend\Mime\Mime;
use Zend\Mime\Part;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\View\Model\ModelInterface;
use Zend\View\Model\ViewModel;

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
        /** @var array $defaultOptions */
        $defaultOptions = $container->build(Module::class, $options);

        if ($container->has('ViewRenderer')) {
            /** @var ModelInterface $viewModel */
            $viewModel = new ViewModel($defaultOptions['variables']);
            $viewModel->setTemplate($defaultOptions['template']);

            /** @var PhpRenderer $renderer */
            $renderer = $container->get('ViewRenderer');

            /** @var string $htmlMarkup */
            $htmlMarkup = $renderer->render($viewModel);
        } else {
            $htmlMarkup = "HTML Example";
        }

        /** @var Part $part */
        $part = new Part($htmlMarkup);
        $part->type = Mime::TYPE_HTML;
        $part->charset = 'utf-8';
        $part->encoding = Mime::ENCODING_QUOTEDPRINTABLE;
        $part->disposition = Mime::DISPOSITION_INLINE;

        return $part;
    }
}
