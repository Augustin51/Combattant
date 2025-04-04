<?php

namespace App\config;

class Router
{
    private $router = [
        "/combattants" => "CombattantController@getAllCombattant",
        "/combattant/(\d+)" => "CombattantController@getCombattantById",
        "/fight/(\d+)/(\d+)" => "CombatController@index",
        "/api/fight" => "CombatController@round",
        "/api/fight/winner" => "CombatController@winner",
    ];

    public function dispatch($requestUri)
    {
        foreach ($this->router as $route => $action) {
            if ($route === $requestUri) {
                return $this->executeAction($action);
            }

            if (preg_match("#^$route$#", $requestUri, $matches)) {
                array_shift($matches);
                return $this->executeAction($action, $matches);
            }
        }

        require_once "src/views/errors/404.php";
        return false;
    }

    private function executeAction($action, $params = [])
    {
        list($controllerName, $methodName) = explode('@', $action);

        $controllerPath = __DIR__ . '/../controllers/' . $controllerName . '.php';
        if (!file_exists($controllerPath)) {
            require_once "src/views/errors/404.php";
            return false;
        }

        $controllerClass = "App\\controllers\\" . $controllerName;
        if (!class_exists($controllerClass)) {
            require_once "src/views/errors/404.php";
            return false;
        }

        $controller = new $controllerClass();
        if (!method_exists($controller, $methodName)) {
            require_once "src/views/errors/404.php";
            return false;
        }

        if (empty($params)) {
            echo $controller->$methodName();
        } else {
            echo $controller->$methodName(...$params);
        }

        return true;
    }
}