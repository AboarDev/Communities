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
        $this->DB->intializeDB();
        $this->config;
    }

    function connect () {
        $this->DB->selectDB();
    }

    function initializeDB () {
        //$this->DB->dropDB();
        $this->DB->createDB();
        $this->DB->selectDB();
        $this->DB->makeTables();
    }

    function display () {
        if ( $this->view != false )
        {
            $this->view->displayElement();
        }
    }

    function addPost ($name, $text) {
        $sql = "insert into Post values (null,001,current_timestamp(),\"$name\",\"$text\");";
        $this->DB->query("aaa",$sql);
    }

    function getPost () {
        $sql = "";
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