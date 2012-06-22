<?php
namespace EnvCheck;

/**
 * Abstract Result.
 *
 * @category    EnvCheck
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @author      Szurovecz János <szjani@szjani.hu>
 */
abstract class AbstractResult implements Result {

  private $message;
  
  private $priority;
  
  /**
   * @param string $message
   * @param int $priority 
   */
  public function __construct($message, $priority) {
    $this->message = $message;
    $this->priority = $priority;
  }
  
  /**
   * @return string
   */
  public function getMessage() {
    return $this->message;
  }

  /**
   * @return int
   */
  public function getPriority() {
    return $this->priority;
  }

}