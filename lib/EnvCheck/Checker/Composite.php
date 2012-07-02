<?php
namespace EnvCheck\Checker;

use EnvCheck\AbstractChecker;
use EnvCheck\Checker;

/**
 * Composite checker to be able to run multiple checkers
 *
 * @category    EnvCheck
 * @package     Checker
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @author      Szurovecz János <szjani@szjani.hu>
 */
class Composite extends AbstractChecker {

    /**
     * @var array
     */
    protected $checkers = array();

    /**
     * If $breakChainOnFailure is true, then if the checker fails, the next checker in the chain,
     * if one exists, will not be executed.
     * 
     * @param \EnvCheck\Checker $checker
     * @param boolean $breakChainOnFailure
     * @return \EnvCheck\Checker\Composite
     */
    public function add(Checker $checker, $breakChainOnFailure = false)
    {
        $this->checkers[] = array('checker' => $checker, 'break' => $breakChainOnFailure);
        return $this;
    }

    /**
     * @return Result Failed if there were one failed result at least
     */
    protected function currentCheck()
    {
        $passed = true;
        foreach ($this->checkers as $checker) {
            $res = $checker['checker']->check();
            $passed = $passed && $res->passed();
            /* @var $observer \EnvCheck\CheckerObserver */
            foreach ($this->observers as $observer) {
                $observer->notify($res);
            }
            if (!$res->passed() && $checker['break']) {
                break;
            }
        }
        return $this->createResult('Composite checker', $passed);
    }

}