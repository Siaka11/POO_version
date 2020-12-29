<?php

namespace App\Core;

use PDO;
use PDOException;

class Db extends PDO
{
    //instance unique de la classe
    private static $instance;

    //Information de la connexion
    private const DBHOST = 'localhost';
    private const DBUSER = 'id14455128_root';
    private const DBPASS = '2iOO1cv%?ZrrDf=4';
    private const DBNAME = 'id14455128_demo_poo';


    private function __construct()
    {
        //DSN de connexion
        $dsn = 'mysql:dbname=' . self::DBNAME . ';host=' . self::DBHOST;

        try {
            parent::__construct($dsn, self::DBUSER, self::DBPASS);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
