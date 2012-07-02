<?php
namespace EnvCheck\Result;

use EnvCheck\AbstractResult;

/**
 * Failed result
 *
 * @category    EnvCheck
 * @package     Result
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @author      Szurovecz János <szjani@szjani.hu>
 */
class Failed extends AbstractResult {

    /**
     * @return boolean 
     */
    public function passed()
    {
        return false;
    }

}