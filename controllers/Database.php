<?php

class Database extends ModelInterface {

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


    // Clean this method up!
    public function find($model, $columns = null) {
        if (is_null($columns)) {
            $class = $this->getClass($model);

            if (!$class) {
                $this->{$model} = 'Table ' . $model . ' does not exist';
                return false;
            }

            $columns = $this->getColumns($class);
        }

        $this->select($columns)->from($model)->where('1=1');
        $data = $this->conn->query($this->getQuery());
        $this->{$model} = $this->buildResults($data);
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

    private function getClass($model) {
        $table = $this->conn->query("SHOW TABLES LIKE '$model'");

        if (empty($table->fetch_all())) {
            return false;
        }

        $model = substr(ucfirst($model), 0, strlen($model) - 1);

        return new $model;
    }
}