<?php
require_once 'IDisplayable.php';
require_once 'AbstractDisplayable.php';
class ViewSite extends AbstractDisplayable implements IDisplayable {
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
        $title = $this->data["title"] ?? '';
        $lang = "en";
        $style = "";
        $signedIn = "";
        $logout = "";
        if ($this->data["signedIn"] ?? false){
            $signedIn = "Logged In" ." as ". $this->data["username"] ?? '';
            $logout = "
            <li class=\"top_link\"><a href=\"logout.php\">Log Out</a></li>";
        }
        //$username = $this->data["username"] ?? 'My Profile';;
        echo "<html lang=\"$lang\">
        <head>
            <title>$title</title>
            <link rel=\"stylesheet\" href=\"style.css\">
        </head><nav>
        <h2 class=\"main_heading\">Gaming Community</h2>
        <ul class=\"top_links\">
            <li class=\"top_link\"><a href=\"index.php\">Home</a></li>
            <li class=\"top_link\"><a href=\"create.php\">New Post</a></li>
            <li class=\"top_link\"><a href=\"profile.php\">My Profile</a></li>
            $logout
            <li class=\"top_link\">$signedIn</li>
        </ul>
        </nav>
        <main>";
    }

    public function displayBodyContent(){
        if (is_array ( $this->child )){
            foreach ($this->child as &$child){
                $child->displayElement();
            }
        }
        else if ($this->child != false){
            $this->child->displayElement();
        }
    }

    public function displayEnd(){
        echo "</main></html>";
    }
}