<?php
namespace eva\core;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;


class Logger implements LoggerInterface {

    use LoggerTrait;

    private $path;
    private $name;

    public function __construct($path = 'logs', $name = 'debug.log')
    {
        $this->path = dirname($_SERVER['DOCUMENT_ROOT']) . '/'. $path;
        $this->name = $name;
        if (!is_dir($path))
        {
            mkdir($this->path, 0755, true);
        }
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function log($level, $message, array $context = array())
    {
        // TODO 写入文件
        // echo date('Y-m-d H:i:s') . ' ' . $level . ': ' . $message . '\r\n';
    }
}