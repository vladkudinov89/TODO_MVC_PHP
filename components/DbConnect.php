<?php

namespace Components;

class DbConnect
{
    public static function getConnection(): array
    {
        return array(
            'host' => '172.20.0.3:3306',
            'dbname' => 'app',
            'user' => 'app',
            'password' => 'secret',
        );
    }
}