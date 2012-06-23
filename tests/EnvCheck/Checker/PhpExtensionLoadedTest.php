<?php
namespace EnvCheck\Checker;
use PHPUnit_Framework_TestCase;

class PhpExtensionLoadedTest extends PHPUnit_Framework_TestCase {
  
  public function testValidCheck() {
    $checker = $this->getMock('EnvCheck\Checker\PhpExtensionLoaded', array('isLoaded'), array('ext'));
    $checker
      ->expects($this->once())
      ->method('isLoaded')
      ->will($this->returnValue(true));
    self::assertTrue($checker->check()->passed());
  }
  
  public function testInValidCheck() {
    $checker = $this->getMock('EnvCheck\Checker\PhpExtensionLoaded', array('isLoaded'), array('ext'));
    $checker
      ->expects($this->once())
      ->method('isLoaded')
      ->will($this->returnValue(false));
    self::assertFalse($checker->check()->passed());
  }
  
}