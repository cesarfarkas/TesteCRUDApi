<?php

namespace TesteCrudApi\Utilits;

class Helpers
{
    public static function jsonResponse(array $data)
    {
        header_remove();
        header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
        header('Content-Type: application/json');

        http_response_code($data['httpResponseCode']);

        echo json_encode($data['data']);
        exit;
    }
}