<?php

interface DBInterface {
    public function intializeDB();

    public function closeDB();

    public function selectDB();

    public function createDB();

    public function query($sql);

    public function isError();
}