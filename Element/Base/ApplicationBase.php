<?php
/**
 * @author Duc Nguyen <ducntq@gmail.com>
 * @link https://github.com/ducntq/Element
 * @copyright Copyright &copy; 2013-2013 GL Software
 * @license https://github.com/ducntq/Element/License
 */

/**
 * ApplicationBase class file
 *
 * ApplicationBase is a class that serves as the basic application.
 *
 * @package Element
 * @since 0.1
 */

namespace Element\Base;


abstract class ApplicationBase {
    private $_config = array();

    public function __construct($config){
        $this->_config = $config;
    }

    abstract public function run();
}