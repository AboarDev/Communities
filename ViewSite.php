<?php
require_once 'IDisplayable.php';
require_once 'AbstractDisplayable.php';
class ViewSite extends AbstractDisplayable implements IDisplayable {

    public function displayStart()
    {
        $title = $this->data["name"] ?? '';
        $lang = $this->data["code"] ?? '';
        $home = $this->data["home"] ?? '';
        $newPost = $this->data["new_post"] ?? '';
        $logout = $this->data["logout"] ?? '';
        $css = $this->data["css"] ?? '';

        $signedIn = "";
        $logoutButton = "";
        if ($this->data["signedIn"] ?? false){
            $signedIn = $this->data["username"] ?? '';
            $logoutButton = "
            <li class=\"top_link\"><a href=\"logout.php\">$logout</a></li>";
        }
        echo "<html lang=\"$lang\">
        <head>
            <title>$title</title>
            <link rel=\"stylesheet\" href=\"Style/base.css\">
            <link rel=\"stylesheet\" href=\"Style/$css.css\">
        </head><nav>
        <h2 class=\"main_heading\">$title</h2>
        <ul class=\"top_links\">
            <li class=\"top_link\"><a href=\"index.php\">$home</a></li>
            <li class=\"top_link\"><a href=\"create.php\">$newPost</a></li>
            $logoutButton
            <li class=\"top_link\">$signedIn</li>
        </ul>
        </nav>
        <main>";
    }

    public function displayBodyContent()
    {
        if (is_array ( $this->child )){
            foreach ($this->child as &$child){
                $child->displayElement();
            }
        }
        else if ($this->child != false){
            $this->child->displayElement();
        }
    }

    public function displayEnd()
    {
        echo "</main></html>";
    }
}