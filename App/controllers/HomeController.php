<?php
namespace TesteCrudApi\Controllers;

use JsonException;
use TesteCrudApi\Utilits\GetHtml;

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

    private function home()
    {
        include __DIR__."\\..\\views\\home.php";
    }

    private function teste()
    {
        include __DIR__."\\..\\views\\teste.php";
    }

}