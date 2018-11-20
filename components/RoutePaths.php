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

            '' => 'site/index',
        );
    }
}