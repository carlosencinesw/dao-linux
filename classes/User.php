<?php

/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 14/05/2017
 * Time: 15:51
 */
class User
{
    private $id;


    private $cpf;
    private $nome;
    private $endereco;
    private $telefone;
    private $email;
    private $senha;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     * @return User
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     * @return User
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param mixed $endereco
     * @return User
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param mixed $telefone
     * @return User
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     * @return User
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
        return $this;
    }

    public function setData($data)
    {
        $this->setId($data['id'])
             ->setCpf($data['cpf'])
             ->setNome($data['nome'])
             ->setEndereco($data['endereco'])
             ->setTelefone($data['telefone'])
             ->setEmail($data['email'])
             ->setSenha($data['senha']);
    }

    public function getUserList()
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_users ORDER BY nome");
    }

    public function search($data)
    {
        $sql = new Sql();

        return $sql->select("select * from tb_users WHERE nome LIKE :nome", [
            ':nome' => $data
        ]);
    }

    public function loadById($id)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_users WHERE id=:id", [
            ':id' => $id
        ]);

        if (count($result) > 0)
        {
            $this->setData($result[0]);
        }
    }

    public function insert()
    {
        $sql = new Sql();

        $result = $sql->select("CALL sp_insert_user(:cpf, :nome, :endereco, :telefone, :email, :senha)", [
            ':cpf'      => $this->getCpf(),
            ':nome'     => $this->getNome(),
            ':endereco' => $this->getEndereco(),
            ':telefone' => $this->getTelefone(),
            ':email'    => $this->getEmail(),
            ':senha'    => $this->getSenha()
        ]);

        if(count($result) > 0)
        {
            $this->setData($result[0]);
        }
    }

    public function __toString()
    {
        return json_encode([
            "id" => $this->getId(),
            "cpf" => $this->getCpf(),
            "nome" => $this->getNome(),
            "endereco" => $this->getEndereco(),
            "telefone" => $this->getTelefone(),
            "email" => $this->getEmail(),
            "senha" => $this->getSenha()
        ]);
    }
}