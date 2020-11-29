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
        echo "";
    }

    public function displayEnd()
    {
        echo "";
    }
}