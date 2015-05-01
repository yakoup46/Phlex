<?php

class Database {

    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $name = DB_NAME;
    private $port = DB_PORT;
    private $conn;
    private $query;
    protected $db;

    public function __construct($db_config = null) {
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->name, $this->port);
        $this->db = $this;
    }

    public function find($table) {
        $this->select('*')->from($table)->where('1=1');
        $data = $this->conn->query($this->getQuery());
        $this->{$table} = $this->buildResults($data);
    }

    public function select($columns) {
        $this->query = "SELECT $columns ";
        
        return $this;
    }

    public function from($table) {
        $this->query .= "FROM $table ";

        return $this;
    }

    public function where($conditions) {
        $this->query .= "WHERE $conditions";

        return $this;
    }

    public function getQuery() {
        return $this->query;
    }

    public function buildResults($results) {
        $array = array();

        foreach ($results as $result) {
            array_push($array, (object) $result);
        }

        return $array;
    }
}