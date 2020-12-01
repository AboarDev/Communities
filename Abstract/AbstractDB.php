<?php
namespace Communities;
abstract class AbstractDB {
    abstract function  __construct($host,$username,$pwd,$dbName);
}