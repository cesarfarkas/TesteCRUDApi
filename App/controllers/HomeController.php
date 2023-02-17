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

    private function home(): mixed
    {
        GetHtml::setHtmlPathFile(__DIR__."\..\public\home.php");
        $page = GetHtml::view();
        return $page;
    }

    private function teste(): mixed
    {
        // clear the old headers
        header_remove();
        // set the header to make sure cache is forced
        header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
        // treat this as json
        header('Content-Type: application/json');

        http_response_code(200);
        return json_encode(
            [
                "status" => "success",
                "message" => "Arquivos salvos",
            ]
        );
    }

}