<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Mail\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Mail\Module;
use Zend\Mail\Transport\Smtp;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mail\Transport\TransportInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Stdlib\ParameterObjectInterface;

/**
 * Class TransportFactory
 * @package MSBios\Mail\Factory
 */
class SmtpTransportFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return $this|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var array $defaultOptions */
        $defaultOptions = $container->build(Module::class, $options);

        /** @var TransportInterface $transport */
        $transport = new Smtp;

        /** @var array $transportOptions */
        $transportOptions = $defaultOptions[Smtp::class];

        /** @var ParameterObjectInterface $options */
        $options = new SmtpOptions($transportOptions);
        $transport->setOptions($options);

        return $transport;
    }
}
