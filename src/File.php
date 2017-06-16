<?php

namespace Micro\Logger\Adapter\File;

use Micro\Logger\Adapterinterface;
use Micro\Driver\File\File as FileDriver;

class File implements AdapterInterface
{
    private $driver;
    private $supportedLevels = [];


    public function __construct(array $config = [])
    {
        $this->driver = new FileDriver($config);

        if (!empty($config['levels'])) {
            $this->supportedLevels = $config['levels'];
        }
    }

    /**
     * @inheritdoc
     */
    public function isSupportedLevel($name)
    {
        if (empty($this->supportedLevels)) {
            return true;
        }

        return in_array($name, $this->supportedLevels, false);
    }

    /**
     * @inheritdoc
     */
    public function log($level, $message, array $context = array())
    {
        $this->driver->log($level, $message, $context);
    }
}
