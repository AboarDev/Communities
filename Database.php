<?php
require_once 'Abstract/AbstractDB.php';
require_once 'Interface/DBInterface.php';
class Database extends AbstractDB implements DBInterface {
    var $DB;
    var $host;
    var $username;
    var $pwd;
    var $dbName;
    function  __construct($host,$username,$pwd,$dbName)
    {
        $this->host = $host;
        $this->username = $username;
        $this->pwd = $pwd;
        $this->dbName = $dbName;
        $this->DB;
    }

    public function connect()
    {
        $this->DB = new mysqli($this->host, $this->username, $this->pwd);
    }

    public function closeDB()
    {
        $this->DB->close();
    }

    public function selectDB()
    {
        $this->DB->select_db($this->dbName);
    }

    public function dropDB ()
    {
        $sql = "drop database if exists $this->dbName";
        $this->DB->query($sql);
    }

    public function createDB()
    {
        $sql = "Create DATABASE $this->dbName";
        $this->DB->query($sql);
    }

    public function makeTables()
    {
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
    }

    public function insertSampleData($dbName)
    {
        //default password is password for testing
        $basePassword = password_hash("password", PASSWORD_DEFAULT);
        //db name either gamingsite or hindisite
        $sql = "insert into AccountType values (5,'admin',true,true,true);";
        $this->DB->query($sql);
        $sql = "insert into AccountType values (4,'moderator',true,true,false);";
        $this->DB->query($sql);
        $sql = "insert into AccountType values (1,'user',true,false,false);";
        $this->DB->query($sql);
        if ($dbName == "gamingsite"){
            $sql = "insert into AccountType values (2,'developer',true,false,false);";
            $this->DB->query($sql);
        } else if ($dbName == "hindisite"){
            $sql = "insert into AccountType values (3,'helper',true,false,true);";
            $this->DB->query($sql);
        }
        $sql = "insert into Users values (5,'TestAdmin','$basePassword','Kamijou','Touma',current_date(),5);";
        $this->DB->query($sql);
        $sql = "insert into Users values (4,'TestModerator','$basePassword','Misaka','Mikoto',current_date(),4);";
        $this->DB->query($sql);
        $sql = "insert into Users values (1,'TestUser','$basePassword','Shokuhou','Misaki',current_date(),1);";
        $this->DB->query($sql);
        if ($dbName == "gamingsite"){
            $sql = "insert into Users values (2,'TestDeveloper','$basePassword','Kanzaki','Kaori',current_date(),2);";
            $this->DB->query($sql);
        } else if ($dbName == "hindisite"){
            $sql = "insert into Users values (3,'TestHelper','$basePassword','Shirai','Kuroko',current_date(),3);";
            $this->DB->query($sql);
        }
        $sql = "insert into Post values (5,5,current_timestamp(),'New Post','Test Post');";
        $this->DB->query($sql);
        $sql = "insert into Post values (4,4,current_timestamp(),'New Post','Test Post');";
        $this->DB->query($sql);
        $sql = "insert into Post values (1,1,current_timestamp(),'New Post','Test Post');";
        $this->DB->query($sql);
        if ($dbName == "gamingsite"){
            $sql = "insert into Post values (2,2,current_timestamp(),'New Post','Test Post');";
            $this->DB->query($sql);
        } else if ($dbName == "hindisite"){
            $sql = "insert into Post values (3,3,current_timestamp(),'New Post','Test Post');";
            $this->DB->query($sql);
        }
    }

    public function query($name,$sql)
    {
        try {
            $queryResult = $this->DB->query($sql);
            return new QueryResult($this,$name, $queryResult);
        } catch (Exception $e) {
            echo "exception";
            throw new Exception($e);
        }
    }

    public function isError()
    {
        $error = mysqli_error ( $this->DB );
    }
}