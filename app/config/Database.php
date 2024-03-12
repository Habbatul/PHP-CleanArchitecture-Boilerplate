<?php

namespace Config {

    class Database
    {

        static function getConnection(): \PDO
        {
            //lakukan penyesuaian
            $host = "";
            $database = "";
            $username = "";
            $password = "";
            
            return new \PDO("mysql:host=$host;dbname=$database", $username, $password);
        }

    }

}
