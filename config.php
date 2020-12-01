<?php
namespace Communities;
class Config {
    var $config;
    function  __construct()
    {
        $this->config = $this->loadConfig();
    }
    function loadConfig ()
    {
        $ini_array = parse_ini_file( 'Config/config.ini', true);
        $config = $ini_array["config"];
        $lang = $config["lang"];
        $dict = $ini_array[$lang];
        return $dict;
    }
    function getConfig ()
    {
        return $this->config;
    }
    function getDBName () {
        return $this->config["db"];
    }
}