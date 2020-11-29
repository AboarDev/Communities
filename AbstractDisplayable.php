<?php

abstract class AbstractDisplayable {
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
}