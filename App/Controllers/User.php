<?php

namespace App\Controllers;

use App\Models\User as ModelUser;


class User extends Base
{

    //Atributos da classe User
    private int $id;
    private string $name;
    private string $email;
    private string $pass;
    private string $hashpass;
    private int $level;


    //Função que realiza o LOGIN, será verificado se o usuário existe e se a senha é a senha informada no banco de dados com criptografia MD5


    public function doLogin(string $email, string $pass)
    {

        //Instanciando a classe App/Models/User para manipular os dados oriundos do banco de dados.
        $user = new ModelUser();

        $user = $user->where('email', $email)->first();

        //Verifica se há Email cadastrado no banco de dados caso não haja informa FALSO na função.
        //E verifica se a senha informada no banco é a mesma informada no POST
        if (is_null($user) || $user->pass != md5($pass)) {
            return false;
        }

        //Se ocorreu tudo ok, retorna true na requisição da validação do usuário
        return true;
    }

    //Função que realiza o cadastro de um novo usuário.

    public function doRegister($args)
    {
    }

    //função que realiza a atualização do usuário, é necessário informar o ID do usuário para atualizar
    //OBS: É necessário enviar via ARRAY com todas as novas informações do usuário em questão

    public function updateUser(array $args)
    {
    }


    //Função que pega apenas um usuário se declarado, do contrário exibirá todos os usuários com exceção do usuário que tem a sessão aberta.
    public function getUser()
    {
    }

    //função que atualiza o usuário
    public function editUser($args)
    {


        return false;
    }

    public function deleteUser($id)
    {


        return false;
    }
}
