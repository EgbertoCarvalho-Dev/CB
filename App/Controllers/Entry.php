<?php

namespace App\Controllers;

use App\Models\Entry as ModelEntry;


class Entry
{
    // Função que salva um novo lançamento
    public function saveEntry(array $args)
    {

        //verifica se foi setado a carga por metros cubicos ou se foi por peso
        if ($args['typeWeight'] == 'M') {
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
            $entries = $entry->findOrFail($id)->toArray();

            //instancia o objeto car
            $car = new Car();

            //pega as informações do carro na classe CAR
            $car = $car->getCar($entries['car']);

            //instancia a classe Fornecedor
            $supplier = new Supplier();

            //Pega as informações de um Fornecedor
            $supplier = $supplier->getSupplier($entries['supplier']);



            //Instancia a classe Usuário
            $userOb = new User();

            $user = $userOb->getUser($entries['manager']);
            $user = $userOb->getUser($entries['responsible']);


            // pega as informações do vetor ITERADO e atualiza o vetor PRINCIPAL
            $entries['manager'] = $user['name'];
            $entries['car'] = $car['placa'];
            $entries['responsible'] = $user['name'];
            $entries['attribute'] = (array) json_decode($entries['attribute']);
            $entries['supplier'] = $supplier['name'];
            $date = new \DateTime($entries['created_at']);
            $entries['created_at'] = $date->format('Y-m-d H:i:s');
        } else {
            $entry = $entry->get();
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
        $entry = new ModelEntry();

        $entry->where('id', $id)->delete();
    }

    public function getActualEntryMonth()
    {

        $date = new \DateTime();

        $entry = new ModelEntry();


        $entry = $entry::whereBetween('created_at', [$date->format('Y-m') . '-01', $date->format('Y-m') . '-31'])->get();

        return $entry->toArray();
    }

    public function getTotalFature()
    {

        $date = new \DateTime();

        $entry = new ModelEntry();


        $entries = $entry->get();
        $total = 0;
        foreach ($entries as $entry) {

            $total += $entry->total;
        }

        return $total;
    }

    public function fatureByMonth()
    {


        $entry = new ModelEntry();


        $jan = $entry::whereRaw('MONTH(created_at) = 01')->sum('total');
        $fev = $entry::whereRaw('MONTH(created_at) = 02')->sum('total');
        $mar = $entry::whereRaw('MONTH(created_at) = 03')->sum('total');
        $abr = $entry::whereRaw('MONTH(created_at) = 04')->sum('total');
        $mai = $entry::whereRaw('MONTH(created_at) = 05')->sum('total');
        $jun = $entry::whereRaw('MONTH(created_at) = 06')->sum('total');
        $jul = $entry::whereRaw('MONTH(created_at) = 07')->sum('total');
        $ago = $entry::whereRaw('MONTH(created_at) = 08')->sum('total');
        $set = $entry::whereRaw('MONTH(created_at) = 09')->sum('total');
        $out = $entry::whereRaw('MONTH(created_at) = 10')->sum('total');
        $nov = $entry::whereRaw('MONTH(created_at) = 11')->sum('total');
        $dez = $entry::whereRaw('MONTH(created_at) = 12')->sum('total');



        $vector = [
            'jan' => $jan,
            'fev' => $fev,
            'mar' => $mar,
            'abr' => $abr,
            'mai' => $mai,
            'jun' => $jun,
            'jul' => $jul,
            'ago' => $ago,
            'set' => $set,
            'out' => $out,
            'nov' => $nov,
            'dez' => $dez
        ];

        return $vector;
    }
}
