<?php
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

return [
    "paths" => [
        "migrations" => "db/migrations"
    ],
    "environments" => [
        "default_migration_table" => "phinxlog",
        "default_database" => "development",
        "development" => [
            "adapter" => "mysql",
            "host" => $_ENV['DB_HOST'],
            "name" => $_ENV['DB_NAME'],
            "user" => $_ENV['DB_USER'],
            "pass" => $_ENV['DB_PASSWORD'],
            "port" => 3306
        ]
    ]
];
