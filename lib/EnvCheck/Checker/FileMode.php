<?php
namespace EnvCheck\Checker;
use EnvCheck\AbstractChecker;
use SplFileInfo;

/**
 * Check whether a file is readable, writable and/or executable.
 *
 * @category    EnvCheck
 * @package     Checker
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @author      Szurovecz János <szjani@szjani.hu>
 */
class FileMode extends AbstractChecker {
  
  const READABLE = 4;
  const WRITABLE = 2;
  const EXECUTABLE = 1;
  const ALL = 7;
  
  /**
   * @var SplFileInfo
   */
  private $file;
  
  /**
   * @var int
   */
  private $mode;
  
  /**
   * @param SplFileInfo $file
   * @param int $mode Flag: READABLE|WRITABLE|EXECUTABLE|ALL
   * @param int $priority 
   */
  public function __construct(SplFileInfo $file, $mode, $priority = 1) {
    parent::__construct($priority);
    $this->file = $file;
    $this->mode = $mode;
  }
  
  /**
   * @return \EnvCheck\Result
   */
  protected function currentCheck() {
    $readable   = $this->file->isReadable();
    $writable   = $this->file->isWritable();
    $executable = $this->file->isExecutable();
    
    $passed = (($this->mode & self::READABLE)   ? $readable   : !$readable)
           && (($this->mode & self::WRITABLE)   ? $writable   : !$writable)
           && (($this->mode & self::EXECUTABLE) ? $executable : !$executable);
    
    return $this->createResult(
      sprintf("Check file access (%d) for file '%s'", $this->mode, $this->file->getPathname()),
      $passed
    );
  }
}