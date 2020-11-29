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

    public function connect(){
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
        $sql = "Create DATABASE $this->dbName";
        $this->DB->query($sql);
    }

    public function makeTables() {
        $sql = "create table AccountType (
            ID int primary key,
            TypeName varchar(10),
            CanPost bool,
            CanDelete bool,
            CanEdit bool
        );";
        $this->DB->query($sql);
        $sql = "create table Users (
            ID int auto_increment primary key,
            Username varchar(15),
            PWD varchar(60),
            LastName varchar(15),
            FirstName varchar(15),
            JoinDate date,
            AccType int,
            foreign key (AccType) references AccountType (ID)
        );";
        $this->DB->query($sql);
        $sql = "create table Post (
            PostNum int auto_increment primary key,
            UserID int,
            PostTime datetime,
            PostTitle varchar(35),
            PostText longtext,
            foreign key(UserID) references Users (ID)
        );";
        $this->DB->query($sql);
        $sql = "create table Tag (
            TagID int auto_increment primary key,
            TagName varchar(15)
        );";
        $this->DB->query($sql);
        $sql = "create table PostTag (
            PostNum int,
            TagID int,
            primary key (TagID,PostNum)
        );";
        $this->DB->query($sql);
    }

    public function query($name,$sql){
        try {
            $queryResult = $this->DB->query($sql);
            return new QueryResult($this,$name, $queryResult);
        } catch (Exception $e) {
            echo "exception";
            throw new Exception($e);
        }
    }

    public function isError(){
        $error = mysqli_error ( $this->DB );
    }
}