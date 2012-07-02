<?php
namespace EnvCheck\Checker;

use EnvCheck\AbstractChecker;

/**
 * Check whether a path is in the include_path or not.
 *
 * @category    EnvCheck
 * @package     Checker
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @author      Szurovecz János <szjani@szjani.hu>
 */
class IsInIncludePath extends AbstractChecker {

    /**
     * @var string
     */
    private $path;

    /**
     * @param string $path
     * @param int $priority
     */
    public function __construct($path, $priority = 1)
    {
        parent::__construct($priority);
        $this->path = rtrim($path, '/');
    }

    /**
     * @return array
     */
    protected function getIncludedPaths()
    {
        return explode(PATH_SEPARATOR, get_include_path());
    }

    /**
     * @return \EnvCheck\Result
     */
    protected function currentCheck()
    {
        return $this->createResult(
            sprintf("Include path check. Required path is '%s'", $this->path),
            in_array($this->path, $this->getIncludedPaths())
        );
    }

}
