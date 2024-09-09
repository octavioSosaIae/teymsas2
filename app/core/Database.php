<?php

class conn
{

    public function connect()
    {

        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "Teymsas2";
        $port = 3306;

        $mysqli = new mysqli($host, $user, $pass, $db, $port);
        return $mysqli;
    }
}
