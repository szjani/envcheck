<?php
namespace EnvCheck\Observer;

use EnvCheck\CheckerObserver;
use EnvCheck\Result;
use Zend_Log;

/**
 * Logging the Result with a Zend_Log object.
 *
 * @category    EnvCheck
 * @package     Observer
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @author      Szurovecz János <szjani@szjani.hu>
 */
class ZendLog implements CheckerObserver {

    /**
     * @var Zend_Log
     */
    private $log;

    /**
     * @param Zend_Log $log 
     */
    public function __construct(Zend_Log $log)
    {
        $this->log = $log;
    }

    /**
     * @param Result $res 
     */
    public function notify(Result $res)
    {
        $this->log->log($res->getMessage(), $res->getPriority(), array('passed' => $res->passed()));
    }

}