<?php
require_once 'IDisplayable.php';
require_once 'AbstractDisplayable.php';
class SimpleDisplayable extends AbstractDisplayable implements IDisplayable {

    public function displayStart()
    {
        echo "";
    }

    public function displayBodyContent()
    {
        $taskSuccess = $this->data["taskSuccess"] ?? false;
        $goBack = $this->data["back"] ?? "";
        $success = $this->data["success"] ?? "";
        $failed = $this->data["failed"] ?? "";
        if($taskSuccess){
            echo "$success <a href=\"index.php\">$goBack</a>";
        } else {
            echo "$failed <a href=\"index.php\">$goBack</a>";
        }
    }

    public function displayEnd()
    {
        echo "";
    }
}