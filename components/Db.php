<?php

namespace Components;

class Db
{
    public static function getConnection()
    {
        try {
            $params = DbConnect::getConnection();

            $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
            $db = new \PDO($dsn, $params['user'], $params['password']);
            $db->exec("set names utf8");
            return $db;
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}