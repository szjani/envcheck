<?php
namespace EnvCheck;

/**
 * Checker interface. These objects can check environment expectations.
 *
 * @category    EnvCheck
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @author      Szurovecz János <szjani@szjani.hu>
 */
interface Checker {
  
  /**
   * Whether it is valid or not.
   * 
   * @return \EnvCheck\Result
   */
  function check();
  
}