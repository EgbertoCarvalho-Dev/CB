<?php

namespace App\Controllers;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Models\Supplier as ModelSupplier;
use App\Controllers\Base;


class Supplier extends Base
{

    // Atributos da classe Supplier (Fornecedor)
    private int $id;
    private string $name;

    //Função que salva um novo fornecedor no banco de dados.
    public function saveSupplier($post)
    {
        //Instancia a classe model do Fornecedor
        $supplier = new ModelSupplier();
        //Insere no banco de dados as informações pertinentes
        $supplier::create($post);

        return true;
    }


    public function getSupplier(int $id = 0)
    {

        //Instancia a classe model do Fornecedor
        $supplier = new ModelSupplier();

        // verifica se é pesquisa apenas de 1 fornecedor especifico ou geral
        if ($id != 0) {
            $supplier = $supplier->findOrFail($id);
        } else {
            $supplier = $supplier->get();
        }


        // retorna as informações obtidas como um Array 
        return $supplier->toArray();
    }

    public function updateSupplier(array $args)
    {

        //Verifica se foi informado o ID, do contrário retorna falso
        if (!isset($args['id'])) {
            return false;
        }

        //Instancia a classe model do Fornecedor
        $supplier = new ModelSupplier();

        // atualiza no banco de dados as informações vindas pelo array
        /*
        formato do array
        array(
            'id' => id,
            'name' => $name
        )
        */
        $supplier->where('id', $args['id'])->update($args);

        return true;
    }

    //função que remove do banco de dados o fornecedor

    public function deleteSupplier($id)
    {



        $supplier = new ModelSupplier();

        $supplier->where('id', $id)->delete();

        return true;
    }
}
