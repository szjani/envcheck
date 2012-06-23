<?php
namespace EnvCheck\Checker;
use PHPUnit_Framework_TestCase;

class FileModeTest extends PHPUnit_Framework_TestCase {
  
  private $fileInfoMock;
  
  public function setUp() {
    $this->fileInfoMock = $this->getMock('\SplFileInfo', array('isWritable', 'isReadable', 'isExecutable'), array('filepath'));
  }
  
  public function testAllAccess() {
    $this->fileInfoMock
      ->expects($this->once())
      ->method('isReadable')
      ->will($this->returnValue(true));
    $this->fileInfoMock
      ->expects($this->once())
      ->method('isWritable')
      ->will($this->returnValue(true));
    $this->fileInfoMock
      ->expects($this->once())
      ->method('isExecutable')
      ->will($this->returnValue(true));
    $checker = new FileMode($this->fileInfoMock, FileMode::ALL);
    $result = $checker->check();
    self::assertTrue($result->passed());
  }
  
  public function testReadableAndWritableAndNotExecutable() {
    $this->fileInfoMock
      ->expects($this->exactly(2))
      ->method('isReadable')
      ->will($this->returnValue(true));
    $this->fileInfoMock
      ->expects($this->exactly(2))
      ->method('isWritable')
      ->will($this->returnValue(true));
    $this->fileInfoMock
      ->expects($this->exactly(2))
      ->method('isExecutable')
      ->will($this->returnValue(false));
    
    $checker = new FileMode($this->fileInfoMock, FileMode::ALL & ~FileMode::EXECUTABLE);
    $result = $checker->check();
    self::assertTrue($result->passed());
    
    $checker = new FileMode($this->fileInfoMock, FileMode::ALL);
    $result = $checker->check();
    self::assertFalse($result->passed());
  }
  
}