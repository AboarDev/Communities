<?php
require_once 'IDisplayable.php';
require_once 'AbstractDisplayable.php';
require_once 'ViewSite.php';
class NewPost extends AbstractDisplayable implements IDisplayable {
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
        echo "<main>
        <form class=\"create_post\" action=\"MakePost.php\" method=\"post\">";
    }

    public function displayEnd(){
        echo "</form>
        </main>";
    }

    public function displayBodyContent(){
        echo "<div>
        <label for=\"title\" class=\"form_label\">Post Title</label>
        <br />
        <input type=\"text\" id=\"title\" name=\"title\" minlength=\"2\" maxlength=\"30\">
        </div>
        <label for=\"posttext\" class=\"form_label\">Post Text</label>
        <br />
        <textarea name=\"posttext\" id=\"posttext\" cols=\"30\" rows=\"10\"></textarea>
        <br />
        <button id=\"submit\">Submit</button>";
    }

}
$data = [];
$data["title"] = "New Post";
$home = new NewPost([],false);
$frame = new ViewSite($data,[$home]);
$frame->displayElement();