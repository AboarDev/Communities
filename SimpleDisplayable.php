<?php
require_once 'IDisplayable.php';
require_once 'AbstractDisplayable.php';
class SimpleDisplayable extends AbstractDisplayable implements IDisplayable {
    var $data;
    var $child;
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