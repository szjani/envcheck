<?php
require_once 'tests/bootstrap.php';

use EnvCheck\Checker;
use EnvCheck\Observer\CliWriter;

$composite = new Checker\Composite(1);
$composite
  ->add(new Checker\PhpVersion('5.4', '>'))
  ->add(new Checker\PhpExtensionLoaded('pdo_mysql'))
  ->add(new Checker\FileMode(new SplFileInfo(__FILE__), Checker\FileMode::ALL))
  ->addObserver(new CliWriter())
  ->check();