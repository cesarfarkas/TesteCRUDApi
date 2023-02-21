<?php

function load(string $controller, string $action, array $request) 
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

       $controllerInstace->getPage($action,$request);
    }
    catch(Exception $e)
    {
       echo $e->getMessage();
    }
}

$routes = [
    "GET" => [
        URL_BASE => fn($request) => load("HomeController","home",$request),
        URL_BASE."usuarios" => fn($request) => load("HomeController","getUsers",$request)
    ],
    "POST" => [
        URL_BASE."usuario/cadastrar" => fn($request) => load("HomeController","addUser",$request),
        URL_BASE."usuario/excluir" => fn($request) => load("HomeController","deleteUser",$request)
    ]
];

try 
{
    $requesMethod = $_SERVER["REQUEST_METHOD"];
    $url = basename($_SERVER['REQUEST_URI']);
    $page = parse_url($_SERVER["REQUEST_URI"])["path"];
    $urlWithQueryString = parse_url($url);
    $queryString = [];
    $request = $_REQUEST;
    
    if(array_key_exists("query",$urlWithQueryString))
    {
        parse_str(parse_url($url)['query'], $urlWithQueryString['query']);
        $queryString = $urlWithQueryString['query'];
    }

    if(!isset($routes[$requesMethod]))
    {
        throw new Exception("O method {$requesMethod} não existe");
    }
    
    if(!array_key_exists($page,$routes[$requesMethod]))
    {
        include(__DIR__."/../views/404.php");
        exit;
    }

    $routes[$requesMethod][$page]($request);

}
catch(Exception $e)
{
    echo $e->getMessage();
}