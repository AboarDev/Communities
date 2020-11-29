<?php
require_once 'IDisplayable.php';
require_once 'AbstractDisplayable.php';
require_once 'ViewSite.php';
require_once "config.php";

class NewPost extends AbstractDisplayable implements IDisplayable {
    var $data;
    public function  __construct($data,$child)
    {
        $this->data = $data;
        $this->child = $child;
    }

    public function displayElement()
    {
        $this->displayStart();
        $this->displayBodyContent();
        $this->displayEnd();
    }

    public function displayStart()
    {
        echo "<main>
        <form class=\"create_post\" action=\"submit.php\" method=\"post\">";
    }

    public function displayEnd()
    {
        echo "</form>
        </main>";
    }

    public function displayBodyContent()
    {
        $content = $this->data["postTitle"] ?? "";
        $text = $this->data["bodyText"] ?? "";

        $postTitle = $this->data["post_title"] ?? "";
        $postText = $this->data["post_text"] ?? "";
        $submit = $this->data["submit"] ?? "";
        echo "<div>
        <label for=\"title\" class=\"form_label\">$postTitle</label>
        <br />
        <input type=\"text\" id=\"title\" name=\"title\" minlength=\"2\" maxlength=\"30\" value=\"$content\">
        </div>
        <label for=\"posttext\" class=\"form_label\">$postText</label>
        <br />
        <textarea name=\"posttext\" id=\"posttext\" cols=\"30\" rows=\"10\">$text</textarea>
        <br />
        <button id=\"submit\">$submit</button>";
        if ($this->data["edit"] ?? false){
            $id = $this->data["id"] ?? null;
            echo "<input name=\"edit\" value=\"true\" type=\"hidden\">
            <input name=\"id\" value=\"$id\" type=\"hidden\">";
        }
    }

}
$config = new Config();

$data = $config->getConfig();

$DBName = $config->getDBName();

if (isset($_REQUEST["edit"])){
    $data["title"] = "New Post";
    $frame = new ViewSite($data,[]);
    
    require_once "Controller.php";
    $controller = new Controller($frame,$DBName);
    $controller->connect();
    $post = $controller->getPost($_REQUEST["id"]);

    $data["edit"] = true;
    $data["id"] = $_REQUEST["id"];
    $data["bodyText"] = $post["PostText"];
    $data["postTitle"] = $post["PostTitle"];

    $home = new NewPost($data,false);
    $frame->child[] = $home;

    $controller->display();
} else{
    $data["title"] = "New Post";
    $data["edit"] = false;

    $home = new NewPost($data,false);
    $frame = new ViewSite($data,[$home]);
    $frame->displayElement();
}