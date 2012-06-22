<?php
namespace EnvCheck;

/**
 * Observer for Checker.
 *
 * @category    EnvCheck
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @author      Szurovecz János <szjani@szjani.hu>
 */
interface CheckerObserver {
  
  /**
   * @param Result $res 
   */
  function notify(Result $res);
  
}