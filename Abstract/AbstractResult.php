<?php
namespace Communities;
abstract class AbstractResult {
    abstract function  __construct($DB,$name,$query);
}