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

    public function displayBodyContent(){
        $delete = $this->data["delete"] ?? '';
        $edit = $this->data["edit"] ?? '';

        $Username = $this->data["Username"];
        $postTitle = $this->data["PostTitle"];
        $bodyText = $this->data["PostText"];
        $id = $this->data["PostNum"];
        echo "<div class=\"post_side\">
        <img class=\"avatar\">
        <br>
        <strong>$Username</strong>
        </div>
        <div class=\"post_main\">
        <a href=\"post.php?id=$id\"><h3>$postTitle</h3></a>
        <p class=\"post_text\">$bodyText</p>
        <div>
        <a href=\"delete.php?id=$id\">$delete</a>
        <a href=\"create.php?edit=true&id=$id\">$edit</a>
        </div></div>";
    }

    public function displayEnd(){
        echo "</div>
        <br>";
    }
}