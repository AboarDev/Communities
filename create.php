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
        <form class=\"create_post\" action=\"submit.php\" method=\"post\">";
    }

    public function displayEnd(){
        echo "</form>
        </main>";
    }

    public function displayBodyContent(){
        $content = $this->data["postTitle"] ?? "";
        $text = $this->data["bodyText"] ?? "";
        echo "<div>
        <label for=\"title\" class=\"form_label\">Post Title</label>
        <br />
        <input type=\"text\" id=\"title\" name=\"title\" minlength=\"2\" maxlength=\"30\" value=\"$content\">
        </div>
        <label for=\"posttext\" class=\"form_label\">Post Text</label>
        <br />
        <textarea name=\"posttext\" id=\"posttext\" cols=\"30\" rows=\"10\">$text</textarea>
        <br />
        <button id=\"submit\">Submit</button>";
    }

}
$data = [];
if (isset($_REQUEST["edit"])){
    //echo $_REQUEST["edit"];
    //echo $_REQUEST["id"];
    $data["title"] = "Edit Post";
    $data["edit"] = true;
    $data["bodyText"] = "New Text";
    $data["postTitle"] = "New Title";
} else{
    $data["title"] = "New Post";
    $data["edit"] = false;
}
$home = new NewPost($data,false);
$frame = new ViewSite($data,[$home]);
$frame->displayElement();