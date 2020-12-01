<?php
namespace Communities;
interface IDisplayable {
    public function displayElement();

    public function displayStart();

    public function displayEnd();
    
    public function displayBodyContent();
}