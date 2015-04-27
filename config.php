<?php

spl_autoload_register(function($class) {
    $path = 'controllers/' . $class . '.php';

    if (!file_exists($path)) {
        exit('Class Name Doesn\'t Match File Name');
    }

    require_once 'controllers/' . $class . '.php';
});