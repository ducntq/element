<?php
/**
 * @author Duc Nguyen <ducntq@gmail.com>
 * @link https://github.com/ducntq/Element
 * @copyright Copyright &copy; 2013-2013 GL Software
 * @license https://github.com/ducntq/Element/License
 */

/**
 * ElementBase class file
 *
 * ElementBase is helper class.
 *
 * It exists to serve common application-level function.
 *
 * @package Element
 * @since 0.1
 */

namespace Element\Base;

/**
 * Gets the application start timestamp.
 */
defined('ELEMENT_START_TIMESTAMP') or define('ELEMENT_START_TIMESTAMP',microtime(true));

/**
 * This constant defines whether the application should be in debug mode or not. Defaults to true.
 */
defined('ELEMENT_DEBUG') or define('ELEMENT_DEBUG', true);

/**
 * Defines the Yii framework installation path.
 */
defined('CORE_PATH') or define('CORE_PATH', dirname(dirname(__FILE__)));

class ElementBase {
    /**
     * @var ApplicationBase
     */
    private static $_app;

    public static function getVersion(){
        return '0.1.1';
    }

    public static function getCorePath(){
        return CORE_PATH;
    }

    /**
     * @param $className
     * @see https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md
     */
    public static function autoLoad($className)
    {
        $className = ltrim($className, '\\');
        $fileName  = '';
        $namespace = '';
        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

        require $fileName;
    }

    /**
     * Error handler
     * @param int $number
     * @param string $string
     * @param string $file
     * @param int $line
     */
    public function error($number, $string, $file, $line)
    {
        throw new \Exception('Error #' . $number . ': ' . $string . ' in ' . $file . ' on line ' . $line);
    }

    public static function setApplication($app){
        self::$_app = $app;
    }

    public static function getApplication(){
        return self::$_app;
    }

    public static function registerAutoLoader(){
        spl_autoload_register(__NAMESPACE__ .'\CElementBase::autoLoad');
    }

    /**
     * Create web application from configuration
     *
     * @param array $config
     * @return CWebApplication
     */
    public static function createWebApplication($config) {
        ElementBase::registerAutoLoader();
        $app = new CWebApplication($config);
        ElementBase::setApplication($app);
        return $app;
    }
}