<?php
require_once 'AbstractDB.php';
require_once 'DBInterface.php';
class Database extends AbstractDB implements DBInterface {
    var $DB;
    var $host;
    var $username;
    var $pwd;
    var $dbName;
    function  __construct($host,$username,$pwd,$dbName){
        $this->host = $host;
        $this->username = $username;
        $this->pwd = $pwd;
        $this->dbName = $dbName;
        $this->DB;
    }

    public function intializeDB(){
        $this->DB = new mysqli($this->host, $this->username, $this->pwd);
    }

    public function closeDB(){
        $this->DB->close();
    }

    public function selectDB(){
        $this->DB->select_db($this->dbName);
    }

    public function dropDB () {
        $sql = "drop database if exists $this->dbName";
        $this->DB->query($sql);
    }

    public function createDB(){
        //CREATE DATABASE IF NOT EXISTS DBname
        $sql = "Create DATABASE IF NOT EXISTS $this->dbName";
        $this->DB->query($sql);
    }

    public function query($name,$sql){
        try {
            $queryResult = $this->DB->query($sql);
            return new QueryResult($this,$name, $queryResult);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function isError(){
        $error = mysqli_error ( $this->DB );
    }
}