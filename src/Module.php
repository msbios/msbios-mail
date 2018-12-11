<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Mail;

use MSBios\ModuleInterface;

/**
 * Class Module
 * @package MSBios\Mail
 */
class Module implements ModuleInterface
{
    /** @const VERSION */
    const VERSION = '1.0.1';

    /**
     * @inheritdoc
     *
     * @return array|mixed|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
