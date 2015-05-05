<?php

spl_autoload_register(function($class) {
    $controller = __DIR__ . '/controllers/' . $class . '.php';
    $model = __DIR__ . '/models/' . $class . '.php';

    if (file_exists($controller)) {
        require_once $controller;
    } elseif (file_exists($model)) {
        require_once $model;
    } else {
        exit('Class Name Doesn\'t Match File Name');
    }
});
