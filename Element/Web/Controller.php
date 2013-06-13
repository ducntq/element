<?php
/**
 * @author Duc Nguyen <ducntq@gmail.com>
 * @link https://github.com/ducntq/Element
 * @copyright Copyright &copy; 2013-2013 GL Software
 * @license https://github.com/ducntq/Element/License
 */

/**
 * Controller class file
 *
 * Controller is a class that has no real actual code, but merely
 * exists to help provide people with an understanding as to how the
 * various PHPDoc tags are used.
 *
 * @package Element
 * @since 0.1
 */

namespace Element\Web;


class Controller {
    public $layout = 'main';

    public $defaultAction = 'index';

    public $pageTitle;

    private $_id;
    private $_action;

    function __construct($id, $action = ''){
        $this->_id = $id;
        $this->_action = !empty($action) ? $action : $this->defaultAction;
    }
}