<?php
require "config.php";

// Inicializando a sessão
session_start();

// Pegando os dados do formulário de login
$login = isset($_POST['login']) ? trim($_POST['login']) : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';

// Enviando os dados para a classe de login para validação
$obj = new Login();
$obj->setCredenciais($login, $senha);

// Chama a função de validação
$retorno = $obj->validar();

// Retorna o resultado para o frontend
echo $retorno;
?>