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
        $args = $args;
        //Transforma a senha com o hash MD5 para adicionar ao banco de dados
        $args['pass'] = md5($args['password']);

        //Remove do vetor a chave password2 para não haver conflitos ao salvar no banco
        unset($args['password2']);
        unset($args['password']);

        //Instancia a classe Model User para inserção dos dados
        $user = new ModelUser();

        //Insere no banco os dados informados.
        $user::create($args);

        // retorna valor da variavel
        return true;
    }

    //função que realiza a atualização do usuário, é necessário informar o ID do usuário para atualizar
    //OBS: É necessário enviar via ARRAY com todas as novas informações do usuário em questão

    public function updateUser(array $args)
    {
        $args = $args;

        if ($args['password'] != "") {
            //Transforma a senha com o hash MD5 para adicionar ao banco de dados
            $args['pass'] = md5($args['password']);
        }
        //Remove do vetor a chave password2 para não haver conflitos ao salvar no banco
        unset($args['password2']);
        unset($args['password']);

        //Instancia a classe Model User para inserção dos dados
        $user = new ModelUser();

        //Insere no banco os dados informados.
        $user::where('id', $args['id'])->update($args);
    }


    //Função que pega apenas um usuário se declarado, do contrário exibirá todos os usuários com exceção do usuário que tem a sessão aberta.
    public function getUser(int $id = 0)
    {
        //Instancia a classe model User para verificar se há usuários
        $user = new ModelUser();

        //verifica se há id informado, do contrário retornará todos os usuários cadastrados
        if ($id != 0) {
            $users = $user->findOrFail($id);
        } else {
            $users = $user->get();
        }

        return $users->toArray();
    }

    public function deleteUser($id)
    {
        //Instancia o modelo User
        $user = new ModelUser();

        //deleta as inforamções do banco de dados referente ao ID
        $user->where('id', $id)->delete();

        return true;
    }

    public function getUserByEmail($email)
    {



        $user = new ModelUser();

        return $user->where('email', $email)->first()->toArray();
    }

    public function doLogout()
    {



        session_start();

        unset($_SESSION);
    }
}
