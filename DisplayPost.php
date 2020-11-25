<?php
require_once 'IDisplayable.php';
require_once 'AbstractDisplayable.php';
require_once 'ViewSite.php';
class DisplayPost extends AbstractDisplayable implements IDisplayable {
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
       
        echo "<div class=\"post\">";
    }

    public function displayEnd(){
        echo "</div>
        <br>";
    }

    public function displayBodyContent(){
        $Username = $this->data["Username"];
        $postTitle = $this->data["PostTitle"];
        $bodyText = $this->data["PostText"];
        echo "<div class=\"post_side\">
        <img class=\"avatar\">
        <br>
        <strong>$Username</strong>
        </div>
        <div class=\"post_main\">
        <h3>$postTitle</h3>
        <p class=\"post_text\">$bodyText</p></div>";
    }
}