<?php
namespace Components;

class RoutePaths
{
    public static function getRoutesPaths(): array
    {
        return array(
            'user/register' => 'user/register',
            'user/login' => 'user/login',
            'user/logout' => 'user/logout',

            'task/add' => 'task/add',
            'page-([0-9]+)' => 'task/index/$1',
            '' => 'task/index/',
        );
    }
}