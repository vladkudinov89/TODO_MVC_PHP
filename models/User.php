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

    public static function isAdmin()
    {
        $db = Db::getConnection();

        $sql = 'SELECT is_admin FROM users WHERE is_admin = 1';

        $result = $db->prepare($sql);
        $result->bindParam(':userId', $userId, PDO::PARAM_INT);


        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    public static function checkUserData($email, $password)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM users WHERE email=:email AND password=:password';
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_INT);

        $result->execute();

        $user = $result->fetch();

        if ($user) {
            return $user['id'];
        }

        return false;

    }

    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged()
    {


        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        header("Location: /user/login");

    }

    public static function isGuest()
    {

        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }
}