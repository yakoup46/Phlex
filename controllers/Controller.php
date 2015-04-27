<?php

class Controller {

    private $class;

    public function load($view) {
        $this->class = strtolower(get_class($this));
        $file = implode('/', array(__DIR__, '../views', $this->class, $view . '.php'));

        if (!file_exists($file)) {
            exit('Invalid File Name');
        }

        echo file_get_contents($file);
    }

}