<?php
namespace TesteCrudApi\Controllers;

use TesteCrudApi\Utilits\Helpers;
use TesteCrudApi\Models\Usuarios;
use TesteCrudApi\Models\Produtos;
use TesteCrudApi\Models\ProdutosUsuarios;

class ApiController
{

    private array $queryString;
    private array $request;

    public function getPage(string $action, array $request): mixed
    {
        $this->request = $request;
        return $this->$action();
    }

    private function getUser()
    {

        if(
            empty($this->request['id'])
        )
        {
            $data = [
                "httpResponseCode"=>400,
                "data" => [
                    "status" => "error",
                    "message" => "ID do usuário não informado"
                ]
            ];
            
            Helpers::jsonResponse($data);
        }

        $getUser = new Usuarios();
        $getUser = $getUser->getUsuario($this->request['id']);

        $getProductsUser = 
        
        $data = [
            "httpResponseCode"=>200,
            "data" => [
                "status" => "success",
                "message" => "Usuário carregado com sucesso",
                "data" => $getUser
            ]
        ];
        
        Helpers::jsonResponse($data);
    }
    
    private function getUserId()
    {
        echo "Teste ID " . $this->request['id'];
    }
}