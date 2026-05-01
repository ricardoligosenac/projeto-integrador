<?php
require_once "config.php";
require_once "verifica-logado.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Pegando os dados do formulário de cliente
$nome = isset($_POST['nome']) ? trim($_POST['nome']) : 'teste';
$email = isset($_POST['email']) ? trim($_POST['email']) : 'teste@teste.com';
$telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : '1999999';
$dataNascimento = isset($_POST['dataNascimento']) ? trim($_POST['dataNascimento']) : time();

// Enviando os dados para a classe de cliente para salvar
$pdo = conectarPDO();
$cliente = new Cliente();
$cliente->setDados($nome, $email, $telefone, $dataNascimento);

if ($cliente->salvar($pdo)) {
    echo json_encode(['status' => 'sucesso']);
} else {
    echo json_encode(['status' => 'erro']);
}
?>