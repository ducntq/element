<?php
/**
 * @author Duc Nguyen <ducntq@gmail.com>
 * @link https://github.com/ducntq/Element
 * @copyright Copyright &copy; 2013-2013 GL Software
 * @license https://github.com/ducntq/Element/License
 */

/**
 * HttpRequest class file
 *
 * HttpRequest is a class that has no real actual code, but merely
 * exists to help provide people with an understanding as to how the
 * various PHPDoc tags are used.
 *
 * @package Element
 * @since 0.1
 */

namespace Element\Web;


class HttpRequest {
    public $requestType;
    public $isAjaxRequest;
    public $isSecureRequest;
    public $port;
    public $queryString;
    public $requestUri;
    public $requestAction;

    function __construct(){
        $this->requestType = $this->getRequestType();
        $this->isAjaxRequest = $this->getIsAjaxRequest();
        $this->isSecureRequest = $this->getIsSecureConnection();
        $this->port = $this->getPort();
        $this->queryString = $this->getQueryString();
        $this->requestUri = $this->getRequestUri();
        if(($queryStringPosition = strpos($this->requestUri, '?')) !== false)
            $this->requestAction = substr($this->requestUri, 0, $queryStringPosition);
        else $this->requestAction = $this->requestUri;
    }

    public function getRequestType(){
        return isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
    }

    public function getIsAjaxRequest(){
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']==='XMLHttpRequest';
    }

    public function getIsSecureConnection()
    {
        return !empty($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'],'off');
    }

    public function getPort()
    {
        return isset($_SERVER['SERVER_PORT']) ? (int)$_SERVER['SERVER_PORT'] : 80;
    }

    public function getQueryString()
    {
        return isset($_SERVER['QUERY_STRING'])?$_SERVER['QUERY_STRING']:'';
    }

    public function getRequestUri()
    {
        $requestUri = '';
        // IIS
        if(isset($_SERVER['HTTP_X_REWRITE_URL'])) $requestUri=$_SERVER['HTTP_X_REWRITE_URL'];
        elseif(isset($_SERVER['REQUEST_URI']))
        {
            $requestUri=$_SERVER['REQUEST_URI'];
            if(!empty($_SERVER['HTTP_HOST']))
            {
                if(strpos($requestUri,$_SERVER['HTTP_HOST'])!==false)
                    $requestUri=preg_replace('/^\w+:\/\/[^\/]+/','', $requestUri);
            }
            else
                $requestUri=preg_replace('/^(http|https):\/\/[^\/]+/i','', $requestUri);
        }
        elseif(isset($_SERVER['ORIG_PATH_INFO']))  // IIS 5.0 CGI
        {
            $requestUri = $_SERVER['ORIG_PATH_INFO'];
            if(!empty($_SERVER['QUERY_STRING']))
                $requestUri.='?'.$_SERVER['QUERY_STRING'];
        }
        return $requestUri;
    }
}