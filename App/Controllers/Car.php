<?php

namespace App\Controllers;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Models\Car as ModelCar;
use App\Controllers\Base;


class Car extends Base
{

    // Atributos da classe Car (Fornecedor)
    private int $id;
    private string $name;

    //Função que salva um novo fornecedor no banco de dados.
    public function saveCar($post)
    {
        //Instancia a classe model do Fornecedor
        $car = new ModelCar();
        //Insere no banco de dados as informações pertinentes
        $car::create($post);

        return true;
    }


    public function getCar(int $id = 0)
    {

        //Instancia a classe model do Fornecedor
        $car = new ModelCar();

        // verifica se é pesquisa apenas de 1 fornecedor especifico ou geral
        if ($id != 0) {
            $car = $car->findOrFail($id);
        } else {
            $car = $car->get();
        }


        // retorna as informações obtidas como um Array 
        return $car->toArray();
    }

    public function updateCar(array $args)
    {

        //Verifica se foi informado o ID, do contrário retorna falso
        if (!isset($args['id'])) {
            return false;
        }

        //Instancia a classe model do Fornecedor
        $car = new ModelCar();

        // atualiza no banco de dados as informações vindas pelo array
        /*
        formato do array
        array(
            'id' => id,
            'name' => $name
        )
        */
        $car->where('id', $args['id'])->update($args);

        return true;
    }

    //função que remove do banco de dados o fornecedor

    public function deleteCar($id)
    {



        $car = new ModelCar();

        $car->where('id', $id)->delete();

        return true;
    }
}
