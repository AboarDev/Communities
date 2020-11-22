<?php
require_once 'IDisplayable.php';
require_once 'AbstractDisplayable.php';
class NewPost extends AbstractDisplayable implements IDisplayable {
    var $data;
    public function  __construct($data,$child) {
        $this->data = $data;
        $this->child = $child;
        //$this->subElements = [];
    }

    public function displayElement(){
        $this->displayStart();
        $this->displayBodyStart();
        $this->displayBodyContent();
        $this->displayBodyEnd();
        $this->displayEnd();
    }

    public function displayStart(){
        echo "<div>";
    }

    public function displayEnd(){
        echo "</div>";
    }

    public function displayBodyStart(){
        echo "<main>
        <form class=\"create_post\" action=\"MakePost.php\" method=\"post\">";
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

    public function displayBodyEnd(){
        echo "</form>
        </main>";
    }
}