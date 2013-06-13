<?php
/**
 * @author Duc Nguyen <ducntq@gmail.com>
 * @link https://github.com/ducntq/Element
 * @copyright Copyright &copy; 2013-2013 GL Software
 * @license https://github.com/ducntq/Element/License
 */

/**
 * CWebApplication class file
 *
 * CWebApplication is a class that has no real actual code, but merely
 * exists to help provide people with an understanding as to how the
 * various PHPDoc tags are used.
 *
 * @package Element
 * @since 0.1
 */

namespace Element\Base;

use Element\Web\HttpRequest;

class CWebApplication extends ApplicationBase {
    /**
     * @var HttpRequest
     */
    public $request;

    public $actionId;

    public $controllerId;

    public function run(){
        $this->request = new HttpRequest();
        $this->route();
    }

    protected function route($requestUri = ''){
        if(strlen($requestUri) == 0) $requestUri = $this->request->requestAction;
        if(strpos($requestUri, '/') == 0) $requestUri = ltrim($requestUri, '/');
        $params = explode('/', $requestUri);
        if(count($params) == 2) {
            $this->controllerId = $params[0];
            $this->actionId = $params[1];
        }
        else {
            $this->controllerId = $params[0];
            $this->actionId = $params[1];
        }

    }
}