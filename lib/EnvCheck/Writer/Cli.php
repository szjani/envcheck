<?php
namespace EnvCheck\Writer;
use EnvCheck\CheckerObserver;
use EnvCheck\Result;

/**
 * Print the result
 *
 * @category    EnvCheck
 * @package     Writer
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @author      Szurovecz János <szjani@szjani.hu>
 */
class Cli implements CheckerObserver {
  
  /**
   * @param Result $res
   */
  public function notify(Result $res) {
    echo $res->getPriority() . ' - ' . ($res->passed() ? 'PASSED' : 'FAILED') . $res->getMessage() . PHP_EOL;
  }
}