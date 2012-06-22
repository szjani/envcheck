<?php
require_once 'tests/bootstrap.php';

use EnvCheck\Checker;
use EnvCheck\Observer\CliWriter;

$composite = new Checker\Composite(1);
$composite->add(new Checker\PhpVersion('5.4', '>'));
$composite->add(new Checker\ExtensionLoaded('pdo_mysql'));
$composite->addObserver(new CliWriter());
$composite->check();