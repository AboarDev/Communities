<?php
require_once "QueryResult.php";
require_once "IResult.php";
require_once "Database.php";
require_once "DBInterface.php";
require_once "IDisplayable.php";

class Controller {
    var $view;
    var $DB;
    var $config;
    function  __construct($view){
        $this->view = $view;
        $this->DB = new Database("localhost","root","","gamingsite");
        $this->DB->connect();
        $this->config;
        session_start();
    }

    function connect () {
        $this->DB->selectDB();
    }

    function initializeDB () {
        $this->DB->createDB();
        $this->DB->selectDB();
        $this->DB->makeTables();
    }

    function verify () {
        if (isset($_SESSION['signedIn'])) {
            return $_SESSION['signedIn'];
        }else {
            return false;
        }
    }

    function display () {
        if ( $this->view != false )
        {
            $this->view->displayElement();
        }
    }

    function logout () {
        if (isset($_SESSION['signedIn'])) {
            $_SESSION['signedIn'] = false;
            $_SESSION['userID'] = null;
        }
    }

    function login($username,$password){
        $sql = "select u.Username, u.PWD, u.ID
        from users u 
        where u.Username = \"$username\";";
        $result = $this->DB->query("aaa",$sql);
        $data = $result->getQuery();
        $hash = $data["PWD"];
        if (password_verify($password,$hash)){
            $_SESSION['signedIn'] = true;
            $_SESSION['userID'] = $data["ID"];
            return true;
        }
        else {
            $_SESSION['signedIn'] = false;
            $_SESSION['userID'] = null;
            return false;
        }
    }

    function register($username,$hash){
        $sql = "insert into Users values (null,'$username','$hash','Kamijou','Touma',current_date(),3);";
        $this->DB->query("aaa",$sql);
    }

    function deletePost ($id){
        $sql = "delete from Post p
        where p.PostNum = $id;";
        $this->DB->query("aaa",$sql);
    }

    function editPost ($id,$newText){
        $sql = "update Post p
        set p.PostText = '$newText'
        where p.PostNum = $id;";
        $this->DB->query("aaa",$sql);
    }

    function addPost ($name, $text) {
        if ($this->verify()){
            $id = $_SESSION['userID'];
            if ($id != null){
                $sql = "insert into Post values (null,$id,current_timestamp(),\"$name\",\"$text\");";
                $this->DB->query("aaa",$sql);
                return true;
            }
            return false;
        }
        return false;
    }

    function getPost ($id) {
        $sql = "select u.Username, u.ID, p.PostNum, p.PostTitle, p.PostText, p.PostTime
        from post p, users u
        where p.PostNum = $id;";
    }

    function getPosts ($postCallback) {
        $sql = "select u.Username, u.ID, p.PostNum, p.PostTitle, p.PostText, p.PostTime
        from post p, users u
        where p.UserID = u.ID;";
        $result = $this->DB->query("Posts",$sql);
        if ( $this->view != false && $result->getSize() > 0)
        {
            while ($row = $result->getQuery())
            {
                $postView = $postCallback($row);
                $this->view->child[] = $postView;
            }
        }
    }
    
    function getPostsByTag () {
        $sql = "";
    }

    function getProfile ($id) {
        $sql = "select U.Username, concat_ws(\" \",U.FirstName, U.LastName) as FullName, U.JoinDate, AC.TypeName as AccType 
        from Users U, AccountType AC 
        where U.AccType = AC.ID
        and AC.ID like $id;";
        $result = $this->DB->query($profile,$sql);
        if ($result->getSize() > 0) {
            $result->getQuery();
            $data = $result->getData();
        }
    }
}