<?php

class ModelInterface {

    public function getColumns($class) {
        $class = new ReflectionClass($class);
        
        return $this->buildSelect($class->getProperties());
    }

    private function buildSelect($properties) {
        $arr = array();

        foreach ($properties as $prop) {
            $arr[] = $prop->name;
        }

        return implode(',', $arr);
    }
}