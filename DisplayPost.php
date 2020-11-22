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
        $this->displayBodyStart();
        $this->displayBodyContent();
        $this->displayBodyEnd();
        $this->displayEnd();
    }

    public function displayStart(){
        $postTitle = $this->data["PostTitle"];
        echo "<main><div class=\"thread_info\">
        <h2>$postTitle</h2>
        <strong>Number of Posts</strong>
        </div>
        <div class=\"post\">";
    }

    public function displayEnd(){
        echo "</div></main>";
    }

    public function displayBodyStart(){
        echo "<div class=\"post_side\">
        <img class=\"avatar\">
        <strong>Name</strong>
        <button>Edit</button>
        <button>Delete</button>
        </div>
        <div class=\"post_main\">
        <p class=\"post_text\">";
    }

    public function displayBodyContent(){
        $bodyText = $this->data["PostText"];
        echo "$bodyText";
    }

    public function displayBodyEnd(){
        echo "</p></div>";
    }
}
$data = [];
$data["PostText"] = "test";
$data["PostTitle"] = "test";
$post = new DisplayPost($data,false);
$frame = new ViewSite(false,$post);
$frame->displayElement();