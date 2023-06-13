<?php

namespace App\Controllers;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Controllers\Base;



class Pages extends Base
{



    public function startPage(Request $request, Response $response)
    {
        $data['title'] = 'Acessar Sistema | Controle de Balança';
        $data['url'] = URL_HOST;


        return $this->getTwig()->render($response, $this->setView('default/Login'), $data);
    }
}
