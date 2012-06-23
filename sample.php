<?php
require_once 'tests/bootstrap.php';

use EnvCheck\Checker;
use EnvCheck\Observer\CliWriter;
use EnvCheck\Observer\ZendLog as ZendLogObserver;
use EnvCheck\Observer\ZendLog\Formatter\ColorCli as ColorCliFormatter;

// create composite checker to check our expectations
$composite = new Checker\Composite(1);
$composite
  ->add(new Checker\PhpVersion('5.4', '>'))
  ->add(new Checker\PhpExtensionLoaded('pdo_mysql'))
  ->add(new Checker\FileMode(new SplFileInfo(__FILE__), Checker\FileMode::ALL));

// write the result to stdout with simple CliWriter
$cliWriter = new CliWriter();
$composite
  ->addObserver($cliWriter)
  ->check();

// write the result to stdout with Zend_Log
$zendLog = new Zend_Log();
$streamWriter = new Zend_Log_Writer_Stream('php://output');
$streamWriter->setFormatter(new ColorCliFormatter());
$zendLog
  ->addWriter($streamWriter)
  ->addFilter(new Zend_Log_Filter_Priority(Zend_Log::INFO, '<'));

$composite
  ->removeObserver($cliWriter)
  ->addObserver(new ZendLogObserver($zendLog))
  ->check();