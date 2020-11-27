<?php
require_once "Controller.php";
require_once 'IDisplayable.php';
require_once 'AbstractDisplayable.php';
require_once 'ViewSite.php';
require_once 'DisplayPost.php';
class HomePage extends AbstractDisplayable implements IDisplayable {
    var $data;
    public function  __construct($data,$child) {
        $this->data = $data;
        $this->child = $child;
    }

    public function displayElement(){
        $this->displayStart();
        $this->displayBodyContent();
        $this->displayEnd();
    }

    public function displayStart(){
        echo "<form class=\"login\" action=\"Login.php\" method=\"post\">";
    }

    public function displayBodyContent(){
        echo "<label for=\"username\" class=\"form_label\">Username</label>
        <input type=\"text\" id=\"username\" name=\"username\" minlength=\"2\" maxlength=\"30\">
        <label for=\"password\" class=\"form_label\">Password</label>
        <input name=\"password\" id=\"password\" type=\"password\">
        <button id=\"submit\">Submit</button>";
    }

    public function displayEnd(){
        echo "</form>
        <h2>Home</h2>";
    }

}
$data = [];
$data["title"] = "Gaming Community";
$home = new HomePage([],false);
$frame = new ViewSite($data,[$home]);
$controller = new Controller($frame);
$controller->connect();
$postCallback = function($data){
    return new DisplayPost($data,false);
};
$controller->getPosts($postCallback);
$controller->verify();
$controller->display();