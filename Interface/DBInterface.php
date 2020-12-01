<?php
namespace Communities;
interface DBInterface {
    public function connect();

    public function closeDB();

    public function selectDB();

    public function createDB();

    public function query($name,$sql);

    public function isError();
}