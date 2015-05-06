<?php

class Home extends Controller {

    public function index() {
        $this->template('basic')->load('home');
    }

}