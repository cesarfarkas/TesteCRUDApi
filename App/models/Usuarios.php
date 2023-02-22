<?php

namespace TesteCrudApi\Models;

use TesteCrudApi\database\Database;
use \PDO;

class Usuarios
{

    /**
     * Nome da tabela baseado no nome da classe
     * @var string
     */
    private $table = "usuarios";

    /**
     * Nome do usuário
     * @var integer
     */
    public $id;

    /**
     * Nome do usuário
     * @var string
     */
    public $nome;

    /**
     * Cpf do usuário
     * @var string
     */
    public $cpf;

    /**
     * Email do usuário
     * @var string
     */
    public $email;

    /**
     * Senha para o teste não está criptografada
     * @var string
     */
    public $senha;

    /**
     * Método responsável por cadastrar uma nova vaga no banco
     * @return boolean
     */
    public function insert()
    {
        //INSERIR A VAGA NO BANCO
        $obDatabase = new Database($this->table);
        $this->id = $obDatabase->insert([
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'email' => $this->email,
            'senha' => $this->senha
        ]);

        //RETORNAR SUCESSO
        return true;
    }

    /**
     * Método responsável por atualizar a vaga no banco
     * @return boolean
     */
    public function update()
    {
        return (new Database($this->table))->update('id = ' . $this->id, [
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'email' => $this->email,
            'senha' => $this->senha
        ]);
    }

    /**
     * Método responsável por excluir a vaga do banco
     * @return boolean
     */
    public function delete()
    {
        return (new Database($this->table))->delete('id = ' . $this->id);
    }

    /**
     * Método responsável por obter as vagas do banco de dados
     * @param  string $where
     * @param  string $order
     * @param  string $limit
     * @return array
     */
    public function getUsuarios($where = null, $order = null, $limit = null)
    {
        return (new Database($this->table))->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Método responsável por buscar uma vaga com base em seu ID
     * @param  integer $id
     * @return user
     */
    public function getUsuario($id)
    {
        return (new Database($this->table))->select('id = ' . $id)
            ->fetchObject(self::class);
    }
}
