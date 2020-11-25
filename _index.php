<?php
require_once 'IDisplayable.php';
require_once 'AbstractDisplayable.php';
require_once 'ViewSite.php';
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
        echo "<main>";
    }

    public function displayEnd(){
        echo "</main>";
    }

    public function displayBodyContent(){
        echo "<form class=\"login\" action=\"Login.php\" method=\"post\">
        <div>
        <label for=\"username\" class=\"form_label\">Username</label>
        <input type=\"text\" id=\"username\" name=\"username\" minlength=\"2\" maxlength=\"30\">
        <label for=\"password\" class=\"form_label\">Password</label>
        <input name=\"password\" id=\"password\">
        <button id=\"submit\">Submit</button>
        </form>
        <h2>Home</h2>";
    }

}
$data = [];
$data["title"] = "Home";
$home = new HomePage(false,false);
$frame = new ViewSite($data,$home);
$frame->displayElement();