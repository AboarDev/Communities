<?php

interface IDisplayable {
    public function displayElement();

    public function displayStart();

    public function displayEnd();

    public function displayBodyStart();

    public function displayBodyContent();

    public function displayBodyEnd();
}