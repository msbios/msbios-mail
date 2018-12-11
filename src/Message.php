<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Mail;

use Zend\Mail\Message as DefaultMessage;
use Zend\Mail\Transport\TransportInterface;

/**
 * Class Message
 * @package MSBios\Mail
 */
class Message extends DefaultMessage
{
    /** @var TransportInterface */
    protected $transport;

    /**
     * @param TransportInterface $transport
     * @return $this
     */
    public function setTransport(TransportInterface $transport)
    {
        $this->transport = $transport;
        return $this;
    }

    /**
     * @param DefaultMessage|null $message
     * @return mixed
     */
    public function send(DefaultMessage $message = null)
    {
        if (is_null($message)) {
            $message = $this;
        }

        return $this
            ->transport
            ->send($message);
    }
}
