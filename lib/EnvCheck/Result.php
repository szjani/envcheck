<?php
namespace EnvCheck;

/**
 * Checkers retrieve Result objects.
 *
 * @category    EnvCheck
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @author      Szurovecz János <szjani@szjani.hu>
 */
interface Result {
  
  /**
   * Message text.
   * 
   * @return string
   */
  function getMessage();
  
  /**
   * Priority to be able to categorize results.
   * 
   * @return int
   */
  function getPriority();
  
  /**
   * Whether the check was passed or failed.
   * 
   * @return boolean
   */
  function passed();
  
}