<?php

namespace TesteCrudApi\Models;

use \TesteCrudApi\Database\Database;
use \PDO;

class ProdutosUsuarios
{
    /**
     * Nome da tabela
     * @var string
     */
    private $table = "produtos_usuarios";

    /**
     * @var integer
     */
    public $id;
    
    /**
     * @var integer
     */
    public $id_produto;
    
    /**
     * @var integer
     */
    public $id_usuario;

    /**
     * Método responsável por obter as produtos usuarios
     * @param  string $where
     * @param  string $order
     * @param  string $limit
     * @return array
     */
    public function getProdutosUsuarios($where = null, $order = null, $limit = null)
    {
        return (new Database($this->table))->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

}
