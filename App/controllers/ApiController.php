<?php
namespace TesteCrudApi\Controllers;

use TesteCrudApi\Utilits\Helpers;
use TesteCrudApi\Models\Usuarios;
use \TesteCrudApi\Models\ProdutosUsuarios;
use TesteCrudApi\Models\Produtos;

class ApiController
{

    private array $queryString;
    private array $request;

    public function getPage(string $action, array $request): mixed
    {
        $this->request = $request;
        return $this->$action();
    }

    private function getUserId()
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
                
        $idUser = $this->request['id'];

        $getUser = new Usuarios();
        $getUser = $getUser->getUsuario($idUser);
        
        if(empty($getUser))
        {
            $data = [
                "httpResponseCode"=>400,
                "data" => [
                    "status" => "error",
                    "message" => "Usuário inexistente"
                ]
            ];
            
            Helpers::jsonResponse($data);
        }

        $getProductsUser = new ProdutosUsuarios();
        $getProductsUser = $getProductsUser->getProdutosUsuarios("id_usuario = $idUser");
        
        $whereProducts = [];

        foreach($getProductsUser as $input)
        {
            $value = "id = " . $input->id_produto . " or ";
            array_push(
                $whereProducts,
                $value
            );
        }

        $whereProducts = mb_substr(implode("",$whereProducts),0,-4);
        $getProducts = [];
        
        if(!empty($whereProducts))
        {
            $getProducts = new Produtos();
            $getProducts = $getProducts->getProdutos($whereProducts);
        }

        $dataUser = ["user"=>$getUser,"products"=>$getProducts];
        
        $data = [
            "httpResponseCode"=>200,
            "data" => [
                "status" => "success",
                "message" => "Usuário carregado com sucesso",
                "data" => $dataUser
            ]
        ];
        
        Helpers::jsonResponse($data);
    }
    
    private function getUser()
    {
        $email = empty($this->request['email'])? "" : $this->request['email'];
        $cpf = empty($this->request['cpf'])? "" : $this->request['cpf'];
        $senha = empty($this->request['senha'])? "" : $this->request['senha'];

        if(
            (empty($email) && empty($cpf)) || 
            empty($senha)
        )
        {
            $data = [
                "httpResponseCode"=>400,
                "data" => [
                    "status" => "error",
                    "message" => "Informe o usuário e senha"
                ]
            ];
            
            Helpers::jsonResponse($data);
        }
            
        
        $getUser = new Usuarios();
        $getUser = $getUser->getUsuarioLogin($email,$cpf,$senha);
        
        if(empty($getUser))
        {
            $data = [
                "httpResponseCode"=>400,
                "data" => [
                    "status" => "error",
                    "message" => "Usuário e ou senha incorretos"
                ]
            ];
            
            Helpers::jsonResponse($data);
        }

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
}