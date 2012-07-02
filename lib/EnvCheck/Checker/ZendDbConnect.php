<?php
namespace EnvCheck\Checker;

use EnvCheck\AbstractChecker;
use Zend_Db_Adapter_Abstract;
use Zend_Db_Exception;

/**
 * Check a database connection with Zend_Db_Adapter.
 *
 * @category    EnvCheck
 * @package     Checker
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @author      Szurovecz János <szjani@szjani.hu>
 */
class ZendDbConnect extends AbstractChecker {

    /**
     * @var Zend_Db_Adapter_Abstract
     */
    private $dbAdapter;

    /**
     * @param Zend_Db_Adapter_Abstract $dbAdapter
     * @param int $priority
     */
    public function __construct(Zend_Db_Adapter_Abstract $dbAdapter, $priority = 1)
    {
        parent::__construct($priority);
        $this->dbAdapter = $dbAdapter;
    }

    /**
     * @return \EnvCheck\Result
     */
    protected function currentCheck()
    {
        $connected = false;
        try {
            $this->dbAdapter->getConnection();
            $connected = true;
        } catch (Zend_Db_Exception $e) {

        }

        return $this->createResult(
            sprintf("Database connection check."), $connected
        );
    }

}