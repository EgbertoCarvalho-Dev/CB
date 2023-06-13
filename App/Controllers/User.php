<?php

namespace App\Controllers;


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
    }

    //Função que realiza o cadastro de um novo usuário.

    public function doRegister(string $name, string $email, string $pass, int $level)
    {
    }

    //função que realiza a atualização do usuário, é necessário informar o ID do usuário para atualizar
    //OBS: É necessário enviar via ARRAY com todas as novas informações do usuário em questão

    public function updateUser(int $id, array $args)
    {
    }


    //Função que pega apenas um usuário se declarado, do contrário exibirá todos os usuários com exceção do usuário que tem a sessão aberta.
    public function getUser()
    {
    }
}
