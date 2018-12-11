<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Mail\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Mail\Message;
use MSBios\Mail\Module;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class MessageFactory
 * @package MSBios\Mail\Factory
 */
class MessageFactory implements FactoryInterface
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
        /** @var array $defaultOptions */
        $defaultOptions = $container->build(Module::class, $options);

        /** @var array $messageConfig */
        $messageConfig = $defaultOptions[$requestedName];

        /** @var Message $message */
        $message = new $requestedName;

        if ($message instanceof Message) {
            $message->setTransport(
                $container->get($messageConfig['transport'])
            );
        }

        /** @var array $from */
        $from = $messageConfig['from'];

        if (is_array($from)) {
            $message
                ->setFrom($from['emailOrAddressList'], $from['name']);
        } else {
            $message
                ->setFrom($from);
        }

        $message
            ->setSubject($messageConfig['subject']);

        return $message;
    }
}
