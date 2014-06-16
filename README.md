# Logentries support for Symfony Console Output
[![Build Status](https://travis-ci.org/jrschumacher/symfony-console-output-logentriesoutput.png)](https://travis-ci.org/jrschumacher/symfony-console-output-logentriesoutput)

## Use

``` php
<?
use Symfony\Component\Console\Output\LogentriesOutput;
use LeLogger;

$logger = new LeLogger($token, $persistent, $ssl, $severity);

new LogentriesOutput($redisClient, $sessionTimeout);

```

