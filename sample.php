<?php
require_once 'tests/bootstrap.php';

use EnvCheck\Checker;
use EnvCheck\Observer\CliWriter;

$composite = new Checker\Composite(1);
$composite->add(new Checker\PhpVersion(1, '5.4', '>'));
$composite->addObserver(new CliWriter());
$composite->check();