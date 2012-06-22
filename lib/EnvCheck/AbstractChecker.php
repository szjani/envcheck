<?php
namespace EnvCheck;
use EnvCheck\Result\Failed;
use EnvCheck\Result\Success;

/**
 * Abstract implementation of Checker.
 * Observers can be attached.
 *
 * @category    EnvCheck
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @author      Szurovecz János <szjani@szjani.hu>
 */
abstract class AbstractChecker implements Checker {

  /**
   * Priority of the checker
   * @var int
   */
  protected $priority = 1;
  
  /**
   * Observers to pass the result of checking
   * @var array
   */
  protected $observers = array();
  
  /**
   * @param int $priority
   */
  public function __construct($priority) {
    $this->priority = (int)$priority;
  }
  
  /**
   * @return Result
   */
  protected abstract function currentCheck();

  /**
   * @return Result
   */
  public function check() {
    $res = $this->currentCheck();
    /* @var $observer CheckerObserver */
    foreach ($this->observers as $observer) {
      $observer->notify($res);
    }
    return $res;
  }
  
  /**
   * Add an observer.
   * 
   * @param \EnvCheck\CheckerObserver $observer
   * @return \EnvCheck\AbstractChecker
   */
  public function addObserver(CheckerObserver $observer) {
    $this->observers[] = $observer;
    return $this;
  }
  
  /**
   * Factory method to create the correct Result object.
   * 
   * @param string $message
   * @param boolean $valid
   * @return Result
   */
  protected function createResult($message, $valid = true) {
    return $valid
      ? new Success($message, $this->priority)
      : new Failed($message, $this->priority);
  }

}