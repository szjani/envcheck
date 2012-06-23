<?php
namespace EnvCheck\Checker;
use PHPUnit_Framework_TestCase;

class PhpVersionCheck extends PHPUnit_Framework_TestCase {
  
  public function testValidCheck() {
    /* @var $checker EnvCheck\Checker */
    $checker = self::getMock('\EnvCheck\Checker\PhpVersion', array('getCurrentVersion'), array('5.3', '>='));
    $checker
      ->expects($this->once())
      ->method('getCurrentVersion')
      ->will($this->returnValue('5.3'));
      
    self::assertTrue($checker->check()->passed());
  }
  
  public function testInvalidCheck() {
    /* @var $checker EnvCheck\Checker */
    $checker = self::getMock('\EnvCheck\Checker\PhpVersion', array('getCurrentVersion'), array('5.4', '>='));
    $checker
      ->expects($this->once())
      ->method('getCurrentVersion')
      ->will($this->returnValue('5.3'));
      
    self::assertFalse($checker->check()->passed());
  }
  
}