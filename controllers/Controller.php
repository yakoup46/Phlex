<?php

class Controller extends Database{

    private $class;

    private $template = false;

    public function load($view) {
        $this->class = strtolower(get_class($this));
        $file = implode('/', array(__DIR__, '../views', $this->class, $view . '.php'));

        if (!file_exists($file)) {
            exit('Invalid File Name');
        }

        ob_start();

        if ($this->template !== false) {
            include __DIR__ . '/../templates/' . $this->template . '/header.php';
            include $file;
            include __DIR__ . '/../templates/' . $this->template . '/footer.php';
        } else {
            include $file;
        }
        
        $output = ob_get_contents();
        ob_end_clean();

        echo $output;
    }

    public function template($template) {
        $this->template = $template;

        return $this;
    }
}