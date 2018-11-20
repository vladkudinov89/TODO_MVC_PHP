<?php

namespace Models;

use Components\Db;
use PDO;

class User
{
    public static function register($name, $email, $password)
    {

        $db = Db::getConnection();

        $sql = 'INSERT INTO users (username, email, password) '
            . 'VALUES (:username, :email, :password)';

        $result = $db->prepare($sql);
        $result->bindParam(':username', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute();
    }
}