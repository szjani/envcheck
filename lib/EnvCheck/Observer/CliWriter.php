<?php
namespace EnvCheck\Observer;
use EnvCheck\CheckerObserver;
use EnvCheck\Result;

/**
 * Print the result
 *
 * @category    EnvCheck
 * @package     Observer
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @author      Szurovecz János <szjani@szjani.hu>
 */
class CliWriter implements CheckerObserver {
  
  /**
   * @param Result $res
   */
  public function notify(Result $res) {
    printf("P%d - %s - %s" . PHP_EOL, $res->getPriority(), ($res->passed() ? 'PASSED' : 'FAILED'), $res->getMessage());
  }
}