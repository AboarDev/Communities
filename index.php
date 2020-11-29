<?php
require_once "Controller.php";
require_once 'IDisplayable.php';
require_once 'AbstractDisplayable.php';
require_once 'ViewSite.php';
require_once 'DisplayPost.php';
require_once 'config.php';
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
$config = new Config();
$data = $config->getConfig();
$DBName = $config->getDBName();

$data["title"] = "Gaming Community";

$home = new HomePage($config->getConfig(),false);
$frame = new ViewSite($data,[$home]);

$controller = new Controller($frame,$DBName);
$controller->connect();

$postCallback = function($theData) use ($data){
    return new DisplayPost(array_merge($theData,$data),false);
};

$search = isset($_REQUEST["name"]);
if (!$search){
    $controller->getPosts($postCallback);
} else {
    $controller->getPostsByName($postCallback,$_REQUEST["name"]);
}

$loggedIn = $controller->verify();
$home->data["showLoginForm"] = $loggedIn;
$controller->display();