<?php
namespace EnvCheck\Observer\ZendLog\Formatter;

use Zend_Log_Formatter_Abstract;
use Zend_Tool_Framework_Client_Console_ResponseDecorator_Colorizer;

/**
 * Colorized log formatter for CliWriter observer.
 *
 * @category    EnvCheck
 * @package     Observer
 * @subpackage  ZendLog
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @author      Szurovecz János <szjani@szjani.hu>
 */
class ColorCli extends Zend_Log_Formatter_Abstract {

    /**
     * @var Zend_Tool_Framework_Client_Console_ResponseDecorator_Colorizer
     */
    private $colorizer;

    public function __construct()
    {
        $this->colorizer = new Zend_Tool_Framework_Client_Console_ResponseDecorator_Colorizer();
    }

    /**
     * Formats data into colorized lines to be written by the writer.
     *
     * @param  array event data
     * @return string formatted line to write to the log
     */
    public function format($event)
    {
        return sprintf(
            "%'-80s\n (%-1s) %-62s%20s\n \t%s\n",
            '-',
            $event['priority'],
            $event['priorityName'],
            $this->colorizer->decorate($event['passed'] ? ' PASSED ' : ' FAILED ',
            $event['passed'] ? 'bgGreen' : 'bgRed'),
            $event['message']
        );
    }

    /**
     * Factory for ColorCli class
     *
     * @param array|Zend_Config $options
     * @return ColorCli
     */
    public static function factory($config)
    {
        return new self();
    }

}