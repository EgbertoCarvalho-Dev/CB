<?php

namespace App\Controllers;

use App\Models\Entry as ModelEntry;


class Entry
{
    // Função que salva um novo lançamento
    public function saveEntry(array $args)
    {
        print_r($args);
        //verifica se foi setado a carga por metros cubicos ou se foi por peso
        if (!$args['meter']['width'] != '' && $args['meter']['length'] != '' && $args['meter']['height'] != '' && $args['meter']['cubic'] != '') {
            $type = 'M';
            $attributes = json_encode($args['meter']);
        } else {
            $type = 'K';
            $attributes = json_encode($args['weight']);
        }

        $args['type'] = $type;
        $args['attribute'] = $attributes;
        unset($args['meter']);
        unset($args['weight']);

        $entry = new ModelEntry();
        $entry::create($args);
    }
    // função que pega uma entrada
    public function getEntry(int $id = 0)
    {

        //instancia o model entry
        $entry = new ModelEntry();

        //verifica se possui id informado
        if ($id != 0) {
            $entry = $entry->findOrFail($id);
        } else {
            $entry = $entry->get();
        }
        // transforma todos os objetos em array
        $entries = $entry->toArray();

        // Executa um looping com iteração de percorrer o vetor para popular com as informações corretas.
        foreach ($entries as $key => $entry) {

            //instancia o objeto car
            $car = new Car();

            //pega as informações do carro na classe CAR
            $car = $car->getCar($entry['car']);

            //instancia a classe Fornecedor
            $supplier = new Supplier();

            //Pega as informações de um Fornecedor
            $supplier = $supplier->getSupplier($entry['supplier']);



            //Instancia a classe Usuário
            $userOb = new User();

            $user = $userOb->getUser($entry['manager']);
            $user = $userOb->getUser($entry['responsible']);


            // pega as informações do vetor ITERADO e atualiza o vetor PRINCIPAL
            $entries[$key]['manager'] = $user['name'];
            $entries[$key]['car'] = $car['placa'];
            $entries[$key]['responsible'] = $user['name'];
            $entries[$key]['attribute'] = (array) json_decode($entry['attribute']);
            $entries[$key]['supplier'] = $supplier['name'];
        }


        return $entries;
    }
    //função que atualiza uma entrada
    public function updateEntry(array $args)
    {
    }
    //função que deleta uma entrada
    public function deleteEntry(int $id)
    {
    }
}
