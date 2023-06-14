<?php

namespace App\Controllers;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use App\Controllers\Base;
use App\Controllers\User;
use App\Controllers\Supplier;



class Pages extends Base
{


    // Função que exibe a página de Login na rota "/" com método GET
    public function startPage(Request $request, Response $response)
    {
        //Recupera as informações gerais de todas as páginas
        $data = $this->getPagesInfo('Acessar Sistema');
        //Exibe o email no campo caso tenha erradoa  senha.
        if (isset($_SESSION['email_user'])) {
            $data['email_user'] = $_SESSION['email_user'];
        }

        return $this->getTwig()->render($response, $this->setView('default/Login'), $data);
    }

    // Função que exibe a página de Login na rota "/" com método POST
    public function doLogin(Request $request, Response $response)
    {
        //Instanciando App/Controllers/User
        $user = new User();

        //Verificando se o usuário existe e se a senha informada é a correta do contrário retorna para a página e tenta login novamente.
        if (!$user->doLogin($_POST['email'], $_POST['password'])) {
            unset($_SESSION['user']);
            //Insere um alerta informando a invalidade das informações
            new Alert('danger', 'Usuário e/ou senha inválidos.');
            $_SESSION['email_user'] = $_POST['email'];
            //Redireciona para a tela de login.
            return $response->withHeader('location', URL_HOST)->withStatus(301);
        }


        //Inicia uma sessão e salva as informações de login.
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['user'] = [
            'email' => $_POST['email'],
            'pass' => $_POST['password']
        ];
        //Redireciona para o Dashboard após toda a verificação
        return $response->withHeader('location', URL_HOST . 'dashboard')->withStatus(301);
    }


    // Função que exibe o DASHBOARD
    public function dashboard(Request $request, Response $response)
    {

        //Recupera as informações gerais de todas as páginas
        $data = $this->getPagesInfo('Dashboard');

        return $this->getTwig()->render($response, $this->setView('default/Pages/Dashboard'), $data);
    }

    //função que exibe os fornecedores
    public function fornecedor(Request $request, Response $response)
    {
        //Recupera as informações gerais de todas as páginas
        $data = $this->getPagesInfo('Fornecedores');

        //Instancia a classe Fornecedor
        $supplier = new Supplier();
        //Chama as informações de todos os fornecedores e exibe na página
        $data['suppliers'] = $supplier->getSupplier();

        return $this->getTwig()->render($response, $this->setView('default/Pages/Fornecedores'), $data);
    }
    //função que exibe os veiculos
    public function veiculo(Request $request, Response $response)
    {
        //Recupera as informações gerais de todas as páginas

        //Instancia a classe Car
        $car = new Car();



        $data = $this->getPagesInfo('Veiculos');

        //Chama as informações de todos os veiculos e exibe na página
        $data['cars'] = $car->getCar();


        return $this->getTwig()->render($response, $this->setView('default/Pages/Veiculos'), $data);
    }

    // função que exibe os usuários
    public function usuario(Request $request, Response $response)
    {
        //Recupera as informações gerais de todas as páginas
        $data = $this->getPagesInfo('Usuários');

        //instancia o controller User
        $user = new User();

        //chama as informações de todos os usuários
        $data['users'] = $user->getUser();

        return $this->getTwig()->render($response, $this->setView('default/Pages/Usuarios'), $data);
    }

    //função que exibe os lançamentos
    public function lancamento(Request $request, Response $response)
    {
        //Recupera as informações gerais de todas as páginas
        $data = $this->getPagesInfo('Lançamentos');

        //recupera todas as informações do veiculo
        $car = new Car();
        $data['cars'] = $car->getCar();


        //Recupera todos os fornecedores
        //Instancia a classe Fornecedor
        $supplier = new Supplier();
        //Chama as informações de todos os fornecedores e exibe na página
        $data['suppliers'] = $supplier->getSupplier();

        //instancia o controller User
        $user = new User();

        //chama as informações de todos os usuários
        $data['users'] = $user->getUser();

        $entry = new Entry();

        $data['entries'] = $entry->getEntry();

        return $this->getTwig()->render($response, $this->setView('default/Pages/Lancamentos'), $data);
    }


    //Função que salva os fornecedores no banco de dados.
    public function saveSupplier(Request $request, Response $response)
    {

        //Instancia o objeto Fornecedor
        $supplier = new Supplier();
        //Envia para o model as informações e salva no banco de dados
        $supplier->saveSupplier($_POST);

        new Alert('success', 'Fornecedor salvo com sucesso.');
        //retorna para a página dos fornecedores
        return $response->withHeader('location', URL_HOST . 'fornecedores')->withStatus(301);
    }

    //Função que pega as informações do fornecedor e envia em formato jSON
    public function getSupplier(Request $request, Response $response)
    {

        //Instancia o controlador do fornecedor 
        $supplier = new Supplier();

        //Recebe as informações do fornecedor
        $supplier = $supplier->getSupplier($_POST['id']);

        //imprime e transforma em jSON as informações obtidas pela variavel $supplier do banco dedados
        $response->getBody()->write(json_encode($supplier));

        //insere o header no formato application/json
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    //Função que edita o fornecedor.
    public function editSupplier(Request $request, Response $response)
    {
        //Instancia o controlador do fornecedor 
        $supplier = new Supplier();

        //atualiza o fornecedor
        $supplier->updateSupplier($_POST);

        //exibe alerta que foi atualizado com sucesso.
        new Alert('success', 'Fornecedor atualizado com sucesso');

        //redireciona para a pagina após a atualização
        return $response->withHeader('location', URL_HOST . 'fornecedores')->withStatus(301);
    }

    //função que remove o fornecedor
    public function deleteSupplier(Request $request, Response $response, $args)
    {
        //Instancia o controlador do fornecedor 
        $supplier = new Supplier();


        //remove o fornecedor de acordo com o get
        $supplier->deleteSupplier($args['id']);

        //exibe alerta que foi atualizado com sucesso.
        new Alert('success', 'Fornecedor removido com sucesso.');

        //redireciona para a pagina após a remoção
        return $response->withHeader('location', URL_HOST . 'fornecedores')->withStatus(301);
    }




    //Função que salva os fornecedores no banco de dados.
    public function saveCar(Request $request, Response $response)
    {

        //Instancia o objeto Fornecedor
        $car = new Car();
        //Envia para o model as informações e salva no banco de dados
        $car->saveCar($_POST);

        new Alert('success', 'Veiculo salvo com sucesso.');
        //retorna para a página dos fornecedores
        return $response->withHeader('location', URL_HOST . 'veiculos')->withStatus(301);
    }

    //Função que pega as informações do fornecedor e envia em formato jSON
    public function getCar(Request $request, Response $response)
    {

        //Instancia o controlador do fornecedor 
        $car = new Car();

        //Recebe as informações do fornecedor
        $car = $car->getCar($_POST['id']);

        //imprime e transforma em jSON as informações obtidas pela variavel $car do banco dedados
        $response->getBody()->write(json_encode($car));

        //insere o header no formato application/json
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    //Função que edita o fornecedor.
    public function editCar(Request $request, Response $response)
    {
        //Instancia o controlador do fornecedor 
        $car = new Car();

        //atualiza o fornecedor
        $car->updateCar($_POST);

        //exibe alerta que foi atualizado com sucesso.
        new Alert('success', 'Veiculo atualizado com sucesso');

        //redireciona para a pagina após a atualização
        return $response->withHeader('location', URL_HOST . 'veiculos')->withStatus(301);
    }

    //função que remove o fornecedor
    public function deleteCar(Request $request, Response $response, $args)
    {
        //Instancia o controlador do fornecedor 
        $car = new Car();


        //remove o fornecedor de acordo com o get
        $car->deleteCar($args['id']);

        //exibe alerta que foi atualizado com sucesso.
        new Alert('success', 'Veiculo removido com sucesso.');

        //redireciona para a pagina após a remoção
        return $response->withHeader('location', URL_HOST . 'veiculos')->withStatus(301);
    }

    //Função que salva os fornecedores no banco de dados.
    public function saveUser(Request $request, Response $response)
    {

        //Instancia o objeto Fornecedor
        $user = new User();
        //Faz uma segunda checagem se a senhas correspondem
        if ($_POST['password'] != $_POST['password2']) {
            new Alert('danger', 'As senhas digitadas não conferem.');
            //retorna para a página dos fornecedores
            return $response->withHeader('location', URL_HOST . 'usuarios')->withStatus(301);
        }
        //Envia para o model as informações e salva no banco de dados
        $user->doRegister($_POST);

        //Exibe alerta que tudo ocorreu bem e foi salvo o usuário
        new Alert('success', 'Usuário salvo com sucesso.');
        //retorna para a página dos usuarios
        return $response->withHeader('location', URL_HOST . 'usuarios')->withStatus(301);
    }

    //Função que pega as informações do fornecedor e envia em formato jSON
    public function getUser(Request $request, Response $response)
    {

        //Instancia o controlador do fornecedor 
        $user = new User();

        //Recebe as informações do fornecedor
        $user = $user->getUser($_POST['id']);

        //imprime e transforma em jSON as informações obtidas pela variavel $user do banco dedados
        $response->getBody()->write(json_encode($user));

        //insere o header no formato application/json
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    //Função que edita o fornecedor.
    public function editUser(Request $request, Response $response)
    {
        //Instancia o controlador do fornecedor 
        $user = new User();

        //atualiza o fornecedor
        $user->updateUser($_POST);

        //exibe alerta que foi atualizado com sucesso.
        new Alert('success', 'Usuário atualizado com sucesso');

        //redireciona para a pagina após a atualização
        return $response->withHeader('location', URL_HOST . 'usuarios')->withStatus(301);
    }

    //função que remove o fornecedor
    public function deleteUser(Request $request, Response $response, $args)
    {
        //Instancia o controlador do fornecedor 
        $user = new User();


        //remove o fornecedor de acordo com o get
        $user->deleteUser($args['id']);

        //exibe alerta que foi atualizado com sucesso.
        new Alert('success', 'Usuário removido com sucesso.');

        //redireciona para a pagina após a remoção
        return $response->withHeader('location', URL_HOST . 'usuarios')->withStatus(301);
    }


    public function saveEntry(Request $request, Response $response)
    {

        //Instancia o controlador dos lancamentos
        $entry = new Entry();
        //salva um novo lancamento
        $entry->saveEntry($_POST);

        //chama um alerta para a entrada
        new Alert('success', 'Foi feito o lançamento com sucesso.');


        return $response->withHeader('location', URL_HOST . 'lancamentos')->withStatus(301);
    }
}
