<?php

require_once 'config.php';
require_once 'settings.php';
require_once 'constants.php';

$parts = array_filter(explode('/', URL));
$controller = current($parts) ?: 'Home';
$method = next($parts) ?: 'index';

if (!class_exists($controller)) {
    exit('Invalid Class Name');
}

if (!method_exists($controller, $method)) {
    exit('Invalid Method Name');
}

(new $controller)->$method();
