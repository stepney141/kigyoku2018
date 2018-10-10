<?php

include_once 'dbconn.php';

class DataMapper
{
    protected $dbconn;

    public function __construct($dbconn)
    {
        if (!$dbconn)
        {
            throw new RuntimeException();
        }

        $this->dbconn = $dbconn;
    }
}