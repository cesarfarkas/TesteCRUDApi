<?php
namespace TesteCrudApi\Controllers;

use TesteCrudApi\Utilits\Helpers;
use TesteCrudApi\Models\Usuarios;

class HomeController
{

    private array $queryString;
    private array $request;

    public function getPage(string $action, array $request): mixed
    {
        $this->request = $request;
        return $this->$action();
    }

    private function home()
    {
        include __DIR__."\\..\\views\\home.php";
    }

    private function addUser()
    {
        if(
            empty($this->request['nome']) || 
            empty($this->request['email']) || 
            empty($this->request['cpf']) || 
            empty($this->request['senha'])
        )
        {
            $data = [
                "httpResponseCode"=>400,
                "data" => [
                    "status" => "error",
                    "message" => "Você precisa preencher todos os campos"
                ]
            ];
            
            Helpers::json($data);
        }

        $addUser = new Usuarios();
        $addUser->nome = $this->request['nome'];
        $addUser->email = $this->request['email'];
        $addUser->cpf = $this->request['cpf'];
        $addUser->senha = $this->request['senha'];

        if(!$addUser->insert())
        {
            $data = [
                "httpResponseCode"=>400,
                "data" => [
                    "status" => "error",
                    "message" => "Não foi possível cadastrar o usuário"
                ]
            ];
            
            Helpers::json($data);
        }

        $data = [
            "httpResponseCode"=>200,
            "data" => [
                "status" => "success",
                "message" => "Usuário cadastrado com sucesso"
            ]
        ];
        
        Helpers::json($data);
    }

    private function deleteUser()
    {
        
        if(empty($this->request['id']))
        {
            $data = [
                "httpResponseCode"=>400,
                "data" => [
                    "status" => "error",
                    "message" => "Erro: Não foi informado o ID do usuário"
                ]
            ];
            
            Helpers::json($data);
        }

        $deleteUser = new Usuarios();
        $deleteUser->id = $this->request['id'];

        if(!$deleteUser->delete())
        {
            $data = [
                "httpResponseCode"=>400,
                "data" => [
                    "status" => "error",
                    "message" => "Erro: Não foi possível excluír o usuário"
                ]
            ];
            
            Helpers::json($data);
        }

        $data = [
            "httpResponseCode"=>200,
            "data" => [
                "status" => "success",
                "message" => "Usuário excluído com sucesso"
            ]
        ];
        
        Helpers::json($data);
    }

    private function getUsers()
    {
        $getUsers = new Usuarios();
        $getUsers = $getUsers->getUsuarios();
        
        $data = [
            "httpResponseCode"=>200,
            "data" => [
                "status" => "success",
                "message" => "Usuários carregados com sucesso",
                "data" => $getUsers
            ]
        ];
        
        Helpers::json($data);
    }
}