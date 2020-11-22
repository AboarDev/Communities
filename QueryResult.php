<?php
include_once "IResult.php";
include_once "AbstractResult.php";
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
            $this->data = $row;
        }
        else {
            $this->data = [];
        }
    }

    public function getData(){
        return $this->data;
    }
}