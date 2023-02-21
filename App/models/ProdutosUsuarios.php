<?php

namespace TesteCrudApi\Models;

use TesteCrudApi\database\Database;
use \PDO;

class ProdutosUsuarios
{

    /**
     * Nome da tabela baseado no nome da classe
     * @var string
     */
    private $table;

    /**
     * Nome do produto
     * @var integer
     */
    public $id;

    /**
     * Nome do produto
     * @var string
     */
    public $nome;

    /**
     * preço do produto
     * @var float
     */
    public $preco;

    function __construct()
    {
        // $tableName = explode(
        //     "\\",
        //     mb_strtolower(
        //         get_class($this)
        //     )
        // );

        // $this->table = $tableName[count($tableName)-1];
        $this->table = "produtos_usuarios";
    }

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
            'preco' => $this->preco
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
            'preco' => $this->preco
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
    public function getProdutosUsuario($where = null, $order = null, $limit = null)
    {
        return (new Database($this->table))->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Método responsável por buscar uma vaga com base em seu ID
     * @param  integer $id
     * @return product
     */
    public function getProdutoUsuario($id)
    {
        return (new Database($this->table))->select('id = ' . $id)
            ->fetchObject(self::class);
    }
}
