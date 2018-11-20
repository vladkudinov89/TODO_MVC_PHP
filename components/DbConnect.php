<?php

namespace Components;

class DbConnect
{
    public static function getConnection(): array
    {
        return array(
            'host' => '172.21.0.2:3306',
            'dbname' => 'app',
            'user' => 'app',
            'password' => 'secret',
        );
    }
}