<?php
namespace EnvCheck;

use EnvCheck\Result\Failed;
use EnvCheck\Result\Success;
use SplObjectStorage;

/**
 * Abstract implementation of Checker.
 * Observers can be attached.
 *
 * @category    EnvCheck
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @author      Szurovecz János <szjani@szjani.hu>
 */
abstract class AbstractChecker implements Checker {

    /**
     * Used for passed results.
     * The same as INFO priority in Zend_Log 
     */
    const PASSED = 6;

    /**
     * Priority of the checker
     * @var int
     */
    protected $priority = 1;

    /**
     * Observers to pass the result of checking
     * @var SplObjectStorage
     */
    protected $observers;

    /**
     * @param int $priority
     */
    public function __construct($priority)
    {
        $this->priority = (int) $priority;
        $this->observers = new SplObjectStorage();
    }

    /**
     * @return Result
     */
    protected abstract function currentCheck();

    /**
     * @return Result
     */
    public function check()
    {
        $res = $this->currentCheck();
        /* @var $observer CheckerObserver */
        foreach ($this->observers as $observer) {
            $observer->notify($res);
        }
        return $res;
    }

    /**
     * Add an observer.
     * 
     * @param \EnvCheck\CheckerObserver $observer
     * @return \EnvCheck\AbstractChecker
     */
    public function addObserver(CheckerObserver $observer)
    {
        $this->observers->attach($observer);
        return $this;
    }

    /**
     * @param CheckerObserver $observer
     * @return \EnvCheck\AbstractChecker 
     */
    public function removeObserver(CheckerObserver $observer)
    {
        $this->observers->detach($observer);
        return $this;
    }

    /**
     * Factory method to create the correct Result object.
     * 
     * @param string $message
     * @param boolean $valid
     * @return Result
     */
    protected function createResult($message, $valid = true)
    {
        return $valid ? new Success($message, self::PASSED) : new Failed($message, $this->priority);
    }

}