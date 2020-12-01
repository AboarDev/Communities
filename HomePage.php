<?php
namespace Communities;
require_once 'Interface/IDisplayable.php';
require_once 'Abstract/AbstractDisplayable.php';
class HomePage extends AbstractDisplayable implements IDisplayable {

    public function displayStart()
    {
        echo "";
    }

    public function displayBodyContent()
    {
        $username = $this->data["username"] ?? '';
        $password = $this->data["password"] ?? '';
        $login = $this->data["login"] ?? '';
        $showLogin = $this->data["showLoginForm"] ?? true;
        if (!$showLogin){
        echo "<form class=\"login\" action=\"Login.php\" method=\"post\">
        <label for=\"username\" class=\"form_label\">$username</label>
        <input type=\"text\" id=\"username\" name=\"username\" minlength=\"2\" maxlength=\"30\">
        <label for=\"password\" class=\"form_label\">$password</label>
        <input name=\"password\" id=\"password\" type=\"password\">
        <button id=\"submit\">$login</button>
        </form>";
        }
    }

    public function displayEnd()
    {
        $home = $this->data["home"] ?? '';
        $search = $this->data["search"] ?? '';
        echo "
        <h2>$home</h2>
        <form class=\"search\" action=\"\" method=\"get\">
        <label for=\"name\" class=\"form_label\">$search</label>
        <input type=\"text\" id=\"name\" name=\"name\" minlength=\"2\" maxlength=\"30\">
        </form>";
    }

}