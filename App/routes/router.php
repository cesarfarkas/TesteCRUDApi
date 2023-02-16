<?php

function load(string $controller, string $action) 
{
    try 
    {
        $controllerNamespace = "TesteCrudApi\\controllers\\{$controller}";
        
        if(!class_exists(($controllerNamespace)))
        {
            throw new Exception("O controller {$controller} não existe");
        }

        $controllerInstace = new $controllerNamespace();

        if(!method_exists($controllerInstace, $action))
        {
            throw new Exception("O  método {$action} não existe no controller {$controller}");
        }

        $controllerInstace->$action();
    }
    catch(Exception $e)
    {
       echo $e->getMessage();
    }
}

$routes = [
    "GET" => [
        URL_BASE => fn() => load("HomeController","teste"),
        URL_BASE."home" => fn() => load("HomeController","teste"),
        URL_BASE."teste" => fn() => load("HomeController","testando")
    ]
];

try 
{
    $uri = parse_url($_SERVER["REQUEST_URI"])["path"];
    $request = $_SERVER["REQUEST_METHOD"];

    if(!isset($routes[$request]))
    {
        throw new Exception("O method {$request} não existe");
    }
    
    if(!array_key_exists($uri,$routes[$request]))
    {
        include(__DIR__."/../public/404.php");
        exit;
    }

    $routes[$request][$uri]();

}
catch(Exception $e)
{
    echo $e->getMessage();
}