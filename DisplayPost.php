<?php
require_once 'Interface/IDisplayable.php';
require_once 'Abstract/AbstractDisplayable.php';
class DisplayPost extends AbstractDisplayable implements IDisplayable {

    public function displayStart()
    {
       
        echo "<div class=\"post\">";
    }

    public function displayBodyContent()
    {
        $delete = $this->data["delete"] ?? '';
        $edit = $this->data["edit"] ?? '';

        $Username = $this->data["Username"];
        $accType = $this->data["TypeName"];
        $postTitle = $this->data["PostTitle"];
        $bodyText = $this->data["PostText"];
        $id = $this->data["PostNum"];
        $FirstName = $this->data["FirstName"];
        $LastName = $this->data["LastName"];
        echo "<div class=\"post_side\">
        <img class=\"avatar\">
        <br>
        <strong>$Username</strong>";
        if ($this->data["db"] == "hindisite"){
            echo "<p><i>$FirstName $LastName</i></p>";
        }
        echo "<p>$accType</p>
        </div>
        <div class=\"post_main\">
        <h3>$postTitle</h3>
        <p class=\"post_text\">$bodyText</p>
        <div>
        <a href=\"delete.php?id=$id\">$delete</a>
        <a href=\"create.php?edit=true&id=$id\">$edit</a>
        </div></div>";
    }

    public function displayEnd()
    {
        echo "</div>
        <br>";
    }
}