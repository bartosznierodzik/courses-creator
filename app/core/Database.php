<?php

class Model {

    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'szkolenia';

    //private $user = '02658984_akademy';
    //private $password = '9FX3iy,umrY!';
    //private $database = '02658984_akademy';

    private $db;//obiekt mysqli

    private $table;//tabela
    private $titles = [];


    public function __construct($table){
        $this->connect();
        $this->table = $table;
        $this->getColumns();
    }

    private function connect(){
        if($connection = new mysqli($this->host, $this->user, $this->password, $this->database)){
            $this->db = $connection;
        }
    }


    private function getColumns(){

        $sql = "SELECT column_name FROM information_schema.columns WHERE table_schema = '" . $this->database . "' AND table_name= '" . $this->table . "' ORDER BY ordinal_position";
        if ($res = $this->db->query($sql)){

            foreach($res->fetch_all() as $row) {
                $this->titles[$row[0]] = '';
            };
        }
    }


    public function set($index, $value){
        if(array_key_exists($index, $this->titles)){
            $this->titles[$index] = $value;
        }
        else return false;//echo "<p>Key <u>" . $index . "</u> doesn't exsist!</p>";
    }

    public function save(){
        if (!$this->titles['id']){
            $sql = "INSERT INTO " . $this->table . " VALUES (";
            foreach ($this->titles as $value) {
                $sql .=  "'" . $value . "',";
            }
            $sql = substr_replace($sql, "", -1);
            $sql .= ")";
        }
        else{
            $sql = "UPDATE " . $this->table . " SET ";
            $titles = array_keys($this->titles);
            foreach ($titles as $key) {
                if($key != 'id'){
                    $sql .= $key . " = '" . $this->titles[$key] . "',";
                }
            }
            $sql = substr_replace($sql, "", -1);
            $sql .= " WHERE id = " . $this->titles['id'];
        }
        if (!$this->db->query($sql)) echo "<p>SQL Error</p> " .$sql;

        unset($this->titles);
        $this->close();
    }

    /*
     * Pobiera jeden kokretny element z bazy po wskazanym indeksie
     * */
    public function load($index, $id){
        $sql = "SELECT * FROM " . $this->table . " WHERE $index = '".$id."'";

        if($res = $this->db->query($sql)){
            if ($res = $res->fetch_assoc()){
                $titles = array_keys($this->titles);

                foreach ($titles as $key) {
                    $this->titles[$key] = $res[$key];
                }
                return true;
            }else return false;//echo "ID doesn't exists in ".$this->table."!";
        }
    }

    public function load2($attributes){
        $sql = "SELECT * FROM " . $this->table . " WHERE ";
        $indexes = array_keys($attributes);
        foreach($indexes as $index) {
            $sql .= "`" . $index . "` = '" . $attributes[$index] . "' AND ";
        }
        $sql = substr($sql, 0, -5);

        if($res = $this->db->query($sql)){
            if ($res = $res->fetch_assoc()){
                $titles = array_keys($this->titles);

                foreach ($titles as $key) {
                    $this->titles[$key] = $res[$key];
                }
                return true;
            }else return false;
        }
    }


    public function get($key){
        if(array_key_exists($key, $this->titles)){
                    return $this->titles[$key];
        }else return false;
    }

    public function getAll($keys = '', $filter = '', $filterKey = ''){
        $keys = explode(',', $keys);
        $sql = "SELECT ";
        foreach($keys as $key){
            $sql .= '`' . $key . '`,';
        }
        $sql = substr($sql, 0, -1);
        $sql .= " FROM " . $this->table;
        if($filter != '' && $filterKey != ''){
            $sql .=" WHERE $filter = '".$filterKey."'";
        }
        if($res = $this->db->query($sql)){
            return $res;
        }else return false;
    }

    public function delete(){
        $this->db->query("DELETE FROM " . $this->table . " WHERE id = " . $this->titles['id']);
        $this->close();
    }

    public function sql($sql){
        $results = $this->db->query($sql);
        return $results;
    }

    public function close(){
        $this->db->close();
    }

    public function dumpResults(){
        echo '<pre>';
            print_r($this->titles);
        echo '</pre>';
    }

}

