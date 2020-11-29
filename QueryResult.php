<?php
include_once "Interface/IResult.php";
include_once "Abstract/AbstractResult.php";
class QueryResult extends AbstractResult implements IResult {
    var $data;
    var $name;
    var $query;
    var $DB;
    function  __construct($DB,$name,$query) {
        $this->DB = $DB;
        $this->data;
        $this->name = $name;
        $this->query = $query;
    }
    
    public function getSize(){
        return mysqli_num_rows( $this->query );
    }
    
    public function getQuery(){
        if ( $row = mysqli_fetch_array( $this->query , MYSQLI_ASSOC ))
        {
            return $row;
        }
        else {
            return [];
        }
    }

    public function getData(){
        return [];
    }
}