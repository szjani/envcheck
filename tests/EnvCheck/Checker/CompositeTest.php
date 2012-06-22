<?php
namespace EnvCheck\Checker;
use PHPUnit_Framework_TestCase;

class CompositeTest extends PHPUnit_Framework_TestCase {
  
  /**
   * @var Composite
   */
  private $compositeChecker;
  
  public function setUp() {
    $this->compositeChecker = new Composite(1);
  }
  
  public function testEmptyCheck() {
    self::assertTrue($this->compositeChecker->check()->passed());
  }
  
  public function testCheckWithCheckerWithoutBreak() {
    $insideRes = new \EnvCheck\Result\Failed("failed", 1);
    $checker = $this->getMock('EnvCheck\Checker', array('check'));
    $checker
      ->expects(self::once())
      ->method('check')
      ->will($this->returnValue($insideRes));
    
    $this->compositeChecker->add($checker);
    self::assertFalse($this->compositeChecker->check()->passed());
  }
  
  public function testCheckWithCheckersWithoutBreak() {
    $insideRes1 = new \EnvCheck\Result\Failed("failed", 1);
    $checker1 = $this->getMock('EnvCheck\Checker', array('check'));
    $checker1
      ->expects(self::once())
      ->method('check')
      ->will($this->returnValue($insideRes1));
    
    $insideRes2 = new \EnvCheck\Result\Success("success", 2);
    $checker2 = $this->getMock('EnvCheck\Checker', array('check'));
    $checker2
      ->expects(self::once())
      ->method('check')
      ->will($this->returnValue($insideRes2));
    
    $this->compositeChecker->add($checker1);
    $this->compositeChecker->add($checker2);
    self::assertFalse($this->compositeChecker->check()->passed());
  }
  
  public function testCheckWithCheckersWithBreak() {
    $insideRes1 = new \EnvCheck\Result\Failed("failed", 1);
    $checker1 = $this->getMock('EnvCheck\Checker', array('check'));
    $checker1
      ->expects(self::once())
      ->method('check')
      ->will($this->returnValue($insideRes1));
    
    $insideRes2 = new \EnvCheck\Result\Success("success", 2);
    $checker2 = $this->getMock('EnvCheck\Checker', array('check'));
    $checker2
      ->expects(self::never())
      ->method('check')
      ->will($this->returnValue($insideRes2));
    
    $this->compositeChecker->add($checker1, true);
    $this->compositeChecker->add($checker2);
    self::assertFalse($this->compositeChecker->check()->passed());
  }
  
    
  public function testCheckNotifyWithChecker() {
    $insideRes = new \EnvCheck\Result\Failed("inside-failed", 1);
    
    $checker = $this->getMock('EnvCheck\Checker', array('check'));
    $checker
      ->expects(self::once())
      ->method('check')
      ->will($this->returnValue($insideRes));
    
    $observer = $this->getMock('EnvCheck\CheckerObserver', array('notify'));
    $observer
      ->expects(self::exactly(2))
      ->method('notify')
      ->will($this->returnCallback(function() use ($insideRes) {
        static $counter = 1;
        $param = func_get_arg(0);
        if ($counter == 1) {
          PHPUnit_Framework_TestCase::assertEquals($insideRes->getMessage(), $param->getMessage());
        } else {
          PHPUnit_Framework_TestCase::assertEquals('Composite checker', $param->getMessage());
        }
        $counter++;
      }));
    
    $this->compositeChecker->addObserver($observer);
    $this->compositeChecker->add($checker);
    self::assertFalse($this->compositeChecker->check()->passed());
  }
  
}