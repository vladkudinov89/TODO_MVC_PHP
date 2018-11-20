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

            'page-([0-9]+)' => 'site/index/$1',
            '' => 'site/index/',
        );
    }
}