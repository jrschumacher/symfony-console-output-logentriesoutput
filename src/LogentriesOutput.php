<?php

/*
 * This file is based on Symfony/Console/Output/StreamOutput.
 */

namespace Symfony\Component\Console\Output;

use Symfony\Component\Console\Formatter\OutputFormatterInterface;

/**
 * LogentriesOutput writes the output to a given logentries instance.
 *
 * Usage:
 * 
 * $leLogger = new LeLogger($token, $persistent, $ssl, $severity);
 *
 * $output = new LogentriesOutput($leLogger);
 *
 * @author Ryan Schumacher <ryan@38pages.com>
 *
 * @api
 */
class LogentriesOutput extends Output
{
    /*
     *  Emergency
     *  Alert
     *  Critical
     *  Error
     *  Warning
     *  Notice
     *  Info
     *  Debug
     */

    private $logger;

    /**
     * Constructor.
     *
     * @param \LeLogger                     $logger    A logentries logger instance
     * @param int                           $verbosity The verbosity level (one of the VERBOSITY constants in OutputInterface)
     * @param bool|null                     $decorated Whether to decorate messages (null for auto-guessing)
     * @param OutputFormatterInterface|null $formatter Output formatter instance (null to use default OutputFormatter)
     *
     * @throws \InvalidArgumentException When first argument is not a real logger
     *
     * @api
     */
    public function __construct(\LeLogger $logger, $verbosity = self::VERBOSITY_NORMAL, $decorated = null, OutputFormatterInterface $formatter = null)
    {
        $this->logger = $logger;

        parent::__construct($verbosity, $decorated, $formatter);
    }

    /**
     * Gets the logger attached to this LogentriesOutput instance.
     *
     * @return resource A logger resource
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * {@inheritdoc}
     */
    protected function doWrite($message, $newline)
    {
        try {
            $this->logger->Info($message, $message.($newline ? PHP_EOL : ''));
        }
        catch(\Exception $e) {
            // should never happen
            throw new \RuntimeException('Unable to write output.');
        }
    }

}