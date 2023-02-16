<?php
namespace TesteCrudApi\Controllers;

class HomeController
{

    private array $queryString;

    public function getPage($action,$queryString): mixed
    {
        $this->queryString = $queryString;
        return $this->$action();
    }

    private function getQueryString($key): string
    {
        if(!empty($this->queryString))
            if(array_key_exists($key,$this->queryString))
                return $this->queryString[$key];

        return "";
    }

    private function home(): mixed
    {
        $t = "<h1>HELLO WORLD</h1>";
        $t .= $this->getQueryString("url");
        return $t;
    }
    
    private function teste(): mixed
    {
        $t = "<h1>TESTE</h1>";
        $t .= $this->getQueryString("url");
        return $t;
    }

}