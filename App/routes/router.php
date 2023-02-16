<?php

function load(string $controller, string $action, array $queryString) 
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

       echo $controllerInstace->getPage($action,$queryString);
    }
    catch(Exception $e)
    {
       echo $e->getMessage();
    }
}

$routes = [
    "GET" => [
        URL_BASE => fn($queryString) => load("HomeController","home",$queryString),
        URL_BASE."teste" => fn($queryString) => load("HomeController","teste",$queryString)
    ]
];

try 
{
    $request = $_SERVER["REQUEST_METHOD"];
    $url = basename($_SERVER['REQUEST_URI']);
    $page = parse_url($_SERVER["REQUEST_URI"])["path"];
    $urlWithQueryString = parse_url($url);
    $queryString = [];

    if(array_key_exists("query",$urlWithQueryString))
    {
        parse_str(parse_url($url)['query'], $urlWithQueryString['query']);
        $queryString = $urlWithQueryString['query'];
    }

    if(!isset($routes[$request]))
    {
        throw new Exception("O method {$request} não existe");
    }
    
    if(!array_key_exists($page,$routes[$request]))
    {
        include(__DIR__."/../public/404.php");
        exit;
    }

    $routes[$request][$page]($queryString);

}
catch(Exception $e)
{
    echo $e->getMessage();
}