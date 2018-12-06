<?php
namespace Components;

class RoutePaths
{
    public static function getRoutesPaths(): array
    {
        return array(
            'user/login' => 'user/login',
            'user/logout' => 'user/logout',

            'task/add' => 'task/add',
            'complete/([0-9]+)' => 'task/complete/$1',
            'task/edit/([0-9]+)' => 'task/edit/$1',
            'rollback/([0-9]+)' => 'task/rollback/$1',
            'delete/([0-9]+)' => 'task/delete/$1',
            '' => 'task/index/',
        );
    }
}