<?php

namespace Components;

class DbConnect
{
    public static function getConnection(): array
    {
        return array(
            'host' => $_ENV['DB_HOST'],
            'dbname' =>  $_ENV['DB_NAME'],
            'user' =>  $_ENV['DB_USER'],
            'password' =>  $_ENV['DB_PASSWORD'],
        );
    }
}