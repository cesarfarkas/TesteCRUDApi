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

    private function insertUser()
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
            
            Helpers::jsonResponse($data);
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
            
            Helpers::jsonResponse($data);
        }

        $data = [
            "httpResponseCode"=>200,
            "data" => [
                "status" => "success",
                "message" => "Usuário cadastrado com sucesso"
            ]
        ];
        
        Helpers::jsonResponse($data);
    }

    private function updateUser()
    {
        if(
            empty($this->request['id']) || 
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
            
            Helpers::jsonResponse($data);
        }

        $updateUser = new Usuarios();
        $updateUser->id = $this->request['id'];
        $updateUser->nome = $this->request['nome'];
        $updateUser->email = $this->request['email'];
        $updateUser->cpf = $this->request['cpf'];
        $updateUser->senha = $this->request['senha'];

        if(!$updateUser->update())
        {
            $data = [
                "httpResponseCode"=>400,
                "data" => [
                    "status" => "error",
                    "message" => "Não foi possível alterar o usuário"
                ]
            ];
            
            Helpers::jsonResponse($data);
        }

        $data = [
            "httpResponseCode"=>200,
            "data" => [
                "status" => "success",
                "message" => "Usuário alterado com sucesso"
            ]
        ];
        
        Helpers::jsonResponse($data);
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
            
            Helpers::jsonResponse($data);
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
            
            Helpers::jsonResponse($data);
        }

        $data = [
            "httpResponseCode"=>200,
            "data" => [
                "status" => "success",
                "message" => "Usuário excluído com sucesso"
            ]
        ];
        
        Helpers::jsonResponse($data);
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
        
        Helpers::jsonResponse($data);
    }
}