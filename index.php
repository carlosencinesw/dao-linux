<?php
/**
 * Created by PhpStorm.
 * User: carlo
 * Date: 14/05/2017
 * Time: 02:12
 */
require_once("config.php");

$user = new User();

$user->setCpf("01002003040")
     ->setNome("teste02")
     ->setEndereco("Rua teste")
     ->setTelefone("98765432")
     ->setEmail("teste@server.com")
     ->setSenha("444555666");

$user->insert();

echo $user;

//
//$data = $sql->select("SELECT * FROM tb_cidades ORDER BY nome");
