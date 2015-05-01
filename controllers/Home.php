<?php

class Home extends Controller {

    public function index() {
        $this->db->find('users');
        $this->load('home');
    }

}