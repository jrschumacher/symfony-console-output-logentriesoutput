<?php

namespace Symfony\Component\Console\Tests\Output;

use Symfony\Component\Console\Output\Output;
use Symfony\Component\Console\Output\LogentriesOutput;
use LeLogger;

class LogentriesOutputTest extends \PHPUnit_Framework_TestCase
{
    protected $logger;

    protected function setUp()
    {
        date_default_timezone_set('UTC');

        $this->logger = LeLogger::getLogger('token', false, false, LOG_DEBUG);
    }

    protected function tearDown()
    {
        LeLogger::tearDown();
        $this->logger = null;
    }

    public function testConstructor()
    {
        $output = new LogentriesOutput($this->logger, Output::VERBOSITY_QUIET, true);
        $this->assertEquals(Output::VERBOSITY_QUIET, $output->getVerbosity(), '__construct() takes the verbosity as its first argument');
        $this->assertTrue($output->isDecorated(), '__construct() takes the decorated flag as its second argument');
    }

    /**
     * @expectedException        \PHPUnit_Framework_Error
     * @expectedExceptionMessage must be an instance of LeLogger
     */
    public function testLoggerIsRequired()
    {
        new LogentriesOutput('foo');
    }

    public function testGetLogger()
    {
        $output = new LogentriesOutput($this->logger);
        $this->assertEquals($this->logger, $output->getLogger(), '->getLogger() returns the current logger');
    }

    public function testDoWrite()
    {
        $output = new LogentriesOutput($this->logger);
        $output->writeln('foo');
        $this->assertTrue($this->logger->isConnected(), '->doWrite() writes to the logger');
    }
}