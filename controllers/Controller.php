<?php

class Controller extends Database {

    private $class;
    private $dir;

    public function load($view, $template = false) {
        $this->dir = getcwd();
        $this->class = strtolower(get_class($this));

        if ($template !== false) {
            $this->massInclude(
                array('templates', $template, 'header.php'),
                array('views', $this->class, $view . '.php'),
                array('templates', $template, 'footer.php')
            );
        } else {
            $this->massInclude(array('views', $this->class, $view . '.php'));
        }
    }

    private function massInclude() {
        foreach(func_get_args() as $parts) {
            include $this->buildUrl($parts);
        }
    }

    private function buildUrl($parts) {
        $file = implode('/', $parts);

        if (!file_exists($file)) {
            exit('Invalid File Name: ' . $parts[count($parts)]);
        }

        return $file;
    }
}