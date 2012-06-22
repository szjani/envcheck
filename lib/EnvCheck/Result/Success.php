<?php
namespace EnvCheck\Result;
use EnvCheck\AbstractResult;

/**
 * Success result
 *
 * @category    EnvCheck
 * @package     Result
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @author      Szurovecz János <szjani@szjani.hu>
 */
class Success extends AbstractResult {
  
  /**
   * @return boolean 
   */
  public function passed() {
    return true;
  }
}