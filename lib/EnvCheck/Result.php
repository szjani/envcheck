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
    public function getMessage();

    /**
     * Priority to be able to categorize results.
     * 
     * @return int
     */
    public function getPriority();

    /**
     * Whether the check was passed or failed.
     * 
     * @return boolean
     */
    public function passed();
}