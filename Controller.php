<?php
declare(strict_types=1);
require_once "QueryResult.php";
require_once "Interface/IResult.php";
require_once "Database.php";
require_once "Interface/DBInterface.php";
require_once "Interface/IDisplayable.php";

class Controller {
    var $view;
    var $DB;
    var $dbName;
    function  __construct(IDisplayable $view, string $dbName)
    {
        $this->view = $view;
        $this->dbName = $dbName;
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
        $this->DB->insertSampleData($this->dbName);
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

    function postByUser (int $postID) : bool
    {
        $id = $_SESSION['userID'];
        $sql = "select u.Username, u.ID, a.TypeName, p.PostTitle, p.PostText, p.PostTime
        from post p, users u, AccountType a
        where p.UserID = u.ID
        and u.AccType = a.ID
        and p.PostNum = $postID;";
        $result = $this->DB->query("Posts",$sql);
        $data = $result->getQuery();
        return $data["ID"] == $id;
    }

    function getAccType () : array
    {
        $id = $_SESSION['userID'];
        $sql = "select u.Username, u.ID, ac.CanPost, ac.CanEdit, ac.CanDelete
        from Users U, AccountType ac 
        where U.AccType = ac.ID
        and u.ID = $id;";
        $result = $this->DB->query("Posts",$sql);
        $data = $result->getQuery();
        return $data;
    }

    function deletePost (int $id) : bool
    {
        if ($this->verify()){
            $accType = $this->getAccType();
            if ($accType["CanDelete"] || $this->postByUser($id)){
                $sql = "delete from Post
                where PostNum = $id;";
                $this->DB->query("aaa",$sql);
                return true;
            }
        }
        return false;
    }

    function editPost (int $id, string $newTitle, string $newText) : bool
    {
        if ($this->verify()){
            $accType = $this->getAccType();
            if ($accType["CanEdit"] || $this->postByUser($id)){
                $sql = "update Post p
                set p.PostTitle = '$newTitle', p.PostText = '$newText'
                where p.PostNum = $id;";
                $this->DB->query("aaa",$sql);
                return true;
            }
        }
        return false;
    }

    function addPost (string $name,string $text) : bool
    {
        if ($this->verify()){
            $accType = $this->getAccType();
            if ($accType["CanPost"]){
                $sql = "insert into Post values (null,$id,current_timestamp(),\"$name\",\"$text\");";
                $this->DB->query("aaa",$sql);
                return true;
            }
        }
        return false;
    }

    function getPosts ($postCallback) : void
    {
        $sql = "select u.Username, u.FirstName, u.LastName, u.ID, p.PostNum, p.PostTitle, p.PostText, p.PostTime, a.TypeName
        from post p, users u, AccountType a
        where p.UserID = u.ID
        and  u.AccType = a.ID
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

    function getPostsByName (Closure $postCallback, string $username) : void
    {
        $sql = "select u.Username, u.ID, p.PostNum, p.PostTitle, p.PostText, p.PostTime, a.TypeName
        from post p, users u, AccountType a
        where p.UserID = u.ID
        and u.Username like \"$username\"
        and  u.AccType = a.ID
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