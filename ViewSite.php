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
        echo "<html lang=\"en\">
        <head>
            <title>$title</title>
            <link rel=\"stylesheet\" href=\"style.css\">
        </head><nav>
        <h2 class=\"main_heading\">Gaming Community</h2>
        <ul class=\"top_links\">
            <li class=\"top_link\"><a href=\"_index.php\">Home</a></li>
            <li class=\"top_link\"><a class=\"current\" href=\"NewPost.php\">New Post</a></li>
            <li class=\"top_link\"><a class=\"current\" href=\"ViewProfile.php\">My Profile</a></li>
        </ul>
        </nav>
        <main>";
    }

    public function displayEnd(){
        echo "</main></html>";
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
}