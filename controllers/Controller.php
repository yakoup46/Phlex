<?php

class Controller extends Database{

    private $class;

    public function load($view) {
        $this->class = strtolower(get_class($this));
        $file = implode('/', array(__DIR__, '../views', $this->class, $view . '.php'));

        if (!file_exists($file)) {
            exit('Invalid File Name');
        }

        ob_start();
        include $file;
        $output = ob_get_contents();
        ob_end_clean();

        echo $output;
    }
}