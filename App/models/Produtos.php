<?php

namespace TesteCrudApi\Models;

use \TesteCrudApi\Database\Database;
use \PDO;

class Produtos
{
    /**
     * Nome da tabela
     * @var string
     */
    private $table = "produtos";

    /**
     * @var integer
     */
    public $id;
    
    /**
     * @var string
     */
    public $nome;
    
    /**
     * @var float
     */
    public $preco;

    /**
     * Método responsável por obter as produtos usuarios
     * @param  string $where
     * @param  string $order
     * @param  string $limit
     * @return array
     */
    public function getProdutos($where = null, $order = null, $limit = null)
    {
        return (new Database($this->table))->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

}
