<?php

namespace Components;

class Router
{
    private $routes;

    public function __construct()
    {
        $this->routes = RoutePaths::getRoutesPaths();
    }

    private function getURI(): string
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }


    public function run(): void
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path)
        {
            if (preg_match("~$uriPattern~", $uri))
            {

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                $segments = explode('/', $internalRoute);
                print_r($segments);
                $controllerName = 'Controllers\\' . ucfirst(array_shift($segments) . 'Controller');

                $actionName = 'action' . ucfirst(array_shift($segments));

                call_user_func_array(array(new $controllerName, $actionName), $segments);

            }
        }

    }
}