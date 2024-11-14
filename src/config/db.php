<?php


class Database {

    static $host = 'localhost';
    static $db = 'postgres';
    static $user = 'postgres';
    static $pass = '20033002';

    static private $instance;

    public static function getInstance()
    {
        if(!isset(self::$instance)){
            try {
                self::$instance = new PDO("pgsql:host=".self::$host.";port=5432;dbname=".self::$db.";", self::$user, self::$pass,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
        }
        return self::$instance;
    }
}
