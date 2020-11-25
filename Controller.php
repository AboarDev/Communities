<?php
require_once "QueryResult.php";
require_once "IResult.php";

require_once "Database.php";
require_once "DBInterface.php";

require_once "DisplayPost.php";
require_once "NewPost.php";
require_once "ViewSite.php";
require_once "IDisplayable.php";

class Controller {
    var $view;
    var $DB;
    var $config;
    function  __construct($view){
        $this->view = $view;
        $this->DB = new Database("localhost","root","","GamingSite");
        $this->DB->intializeDB();
        $this->DB->selectDB();
        $this->config;
    }

    function display () {
        $this->view->displayElement();
    }

    function addPost ($name, $text) {
        $sql = "insert into Post values (001,current_timestamp(),\"$name\",\"$text\");";
        //$this->DB->query($post,$sql);
    }

    function getPost () {
        $sql = "";
    }

    function getPosts () {
        $sql = "";
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
//$controller = new Controller(1);