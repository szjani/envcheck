<?php
namespace EnvCheck\Checker;
use EnvCheck\AbstractChecker;

/**
 * Check PHP version
 *
 * @category    EnvCheck
 * @package     Checker
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @author      Szurovecz János <szjani@szjani.hu>
 */
class PhpVersion extends AbstractChecker {
  
  /**
   * First operator of the comparing
   * @var string
   */
  private $version;
  
  /**
   * Operator, like <, <=, =, >, >=
   * @var string
   */
  private $operator;
  
  /**
   * 
   * @param int $priority
   * @param string $version
   * @param string $operator
   */
  public function __construct($priority, $version, $operator) {
    parent::__construct($priority);
    $this->version = $version;
    $this->operator = $operator;
  }
  
  protected function getCurrentVersion() {
    return PHP_VERSION;
  }
  
  /**
   * @return \EnvCheck\Result
   */
  protected function currentCheck() {
    $phpVersion = $this->getCurrentVersion();
    return $this->createResult(
      "Your current PHP version is " . $phpVersion,
      version_compare($phpVersion, $this->version, $this->operator)
    );
  }
}