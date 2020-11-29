<?php
require_once "QueryResult.php";
require_once "IResult.php";
require_once "Database.php";
require_once "DBInterface.php";
require_once "IDisplayable.php";

class Controller {
    var $view;
    var $DB;
    function  __construct($view, string $dbName)
    {
        $this->view = $view;
        $this->DB = new Database("localhost","root","",$dbName);
        $this->DB->connect();
        session_start();
    }
    function connect (): void
    {
        $this->DB->selectDB();
    }

    function initializeDB () : void
    {
        $this->DB->createDB();
        $this->DB->selectDB();
        $this->DB->makeTables();
    }

    function verify (): bool 
    {
        if (isset($_SESSION['signedIn'])) {
            return $_SESSION['signedIn'];
        }else {
            return false;
        }
    }

    function display () : void
    {
        if ( $this->view != false )
        {
            if ($this->verify()){
                $this->view->data["signedIn"] = true;
                $this->view->data["username"] = $this->getUsername();
            }else {
                $this->view->data["signedIn"] = false;
            }
            
            $this->view->displayElement();
        }
    }

    function getUsername ():string 
    {
        if (isset($_SESSION['username'])){
            return $_SESSION['username'];
        }
        return "";
    }

    function logout () : void
    {
        if (isset($_SESSION['signedIn'])) {
            unset($_SESSION['signedIn']);
            unset($_SESSION['userID']);
            unset($_SESSION['username']);
        }
    }

    function login(string $username,string $password) : bool
    {
        $sql = "select u.username, u.PWD, u.ID
        from users u 
        where u.username = \"$username\";";
        $result = $this->DB->query("aaa",$sql);
        $data = $result->getQuery();
        $hash = $data["PWD"];
        if (password_verify($password,$hash)){
            $_SESSION['signedIn'] = true;
            $_SESSION['userID'] = $data["ID"];
            $_SESSION['username'] = $data["username"];
            return true;
        }
        else {
            return false;
        }
    }

    function deletePost (int $id) : void
    {
        $sql = "delete from Post
        where PostNum = $id;";
        $this->DB->query("aaa",$sql);
    }

    function editPost (int $id, string $newTitle, string $newText) : void
    {
        $sql = "update Post p
        set p.PostTitle = '$newTitle', p.PostText = '$newText'
        where p.PostNum = $id;";
        $this->DB->query("aaa",$sql);
    }

    function addPost (string $name,string $text) : bool
    {
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

    function getPosts ($postCallback) : void
    {
        $sql = "select u.Username, u.ID, p.PostNum, p.PostTitle, p.PostText, p.PostTime
        from post p, users u
        where p.UserID = u.ID
        order by p.PostTime desc;";
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

    function getPostsByName ($postCallback, string $username) : void
    {
        $sql = "select u.Username, u.ID, p.PostNum, p.PostTitle, p.PostText, p.PostTime
        from post p, users u
        where p.UserID = u.ID
        and u.Username like \"$username\"
        order by p.PostTime desc;";
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
}