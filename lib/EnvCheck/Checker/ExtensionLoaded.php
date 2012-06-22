<?php
namespace EnvCheck\Checker;
use EnvCheck\AbstractChecker;
use EnvCheck\Result;

/**
 * Check that a PHP extension has been loaded or not.
 *
 * @category    EnvCheck
 * @package     Checker
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @author      Szurovecz János <szjani@szjani.hu>
 */
class ExtensionLoaded extends AbstractChecker {
  
  protected $extensionName;
  
  /**
   * @param string $extensionName
   * @param int $priority 
   */
  public function __construct($extensionName, $priority = 1) {
    parent::__construct($priority);
    $this->extensionName = $extensionName;
  }
  
  /**
   * @return boolean
   */
  protected function isLoaded() {
    return extension_loaded($this->extensionName);
  }
  
  /**
   * @return \EnvCheck\Result 
   */
  protected function currentCheck() {
    return $this->createResult(
      sprintf("Whether PHP extension '%s' has been loaded", $this->extensionName),
      $this->isLoaded() 
    );
  }
}