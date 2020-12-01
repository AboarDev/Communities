<?php
namespace Communities;
require_once 'Interface/IDisplayable.php';
require_once 'Abstract/AbstractDisplayable.php';

class NewPost extends AbstractDisplayable implements IDisplayable {

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