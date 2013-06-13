<?php
chdir(dirname(__FILE__));
const DS = DIRECTORY_SEPARATOR;
$config = require(dirname(__FILE__) . DS . 'Application' . DS . 'Config' . DS . 'main.php');


use Element\Element;
require(dirname(__FILE__) . DS . 'Element' . DS .'Element.php');

$app = Element::createWebApplication($config);
$app->run();