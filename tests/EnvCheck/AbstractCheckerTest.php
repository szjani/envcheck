<?php
namespace EnvCheck;
use PHPUnit_Framework_TestCase;

class AbstractCheckerTest extends PHPUnit_Framework_TestCase {
  
  private $checker;
  
  private $res;
  
  public function setUp() {
    $res = new Result\Success("success", 1);
    $checker = $this->getMock('EnvCheck\AbstractChecker', array('currentCheck'), array(1));
    $checker
      ->expects(self::once())
      ->method('currentCheck')
      ->will($this->returnValue($res));
    $this->checker = $checker;
    $this->res = $res;
  }
  
  public function testCheck() {
    $this->checker->check();
  }
  
  public function testAddObserver() {
    $observer = $this->getMock('EnvCheck\CheckerObserver', array('notify'));
    $observer
      ->expects(self::once())
      ->method('notify')
      ->with($this->res);
    $this->checker->addObserver($observer);
    $this->checker->check();
  }
  
}