<?php

namespace App\Controllers;

use App\Traits\Template;

abstract class Base
{
    use Template;


    //Função que exibe as informações gerais de todas as páginas

    public function getPagesInfo($title)
    {

        //Titulo da página
        $data['title'] = $title . ' | Controle de Balança';


        //Verifica se errou a senha e chama a tratativa de erro
        if (!isset($_SESSION)) {
            session_start();
        }
        //Exibe o email no campo caso tenha erradoa  senha.

        $data['msg'] = Alert::showMsg();

        //URL base que é configurado no arquivo App/Config/Config.php
        $data['url'] = URL_HOST;

        return $data;
    }
}
