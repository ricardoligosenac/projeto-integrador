<?php
require_once "config/config.php";
require_once "verifica-logado.php";

// Pegando os dados do formulário de cliente
$nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : '';
$dataNascimento = isset($_POST['dataNascimento']) ? trim($_POST['dataNascimento']) : '';

// Enviando os dados para a classe de cliente para salvar
$pdo = conectarPDO();
$cliente = new Cliente();

// Validando se os dados estão corretos e atribuindo os valores à classe.
try {
    $cliente->setDados($nome, $email, $telefone, $dataNascimento);
} catch (InvalidArgumentException $e) {
    echo json_encode(['status' => 'erro', 'mensagem' => $e->getMessage()]);
    exit;
}

// Salvando o cliente no banco de dados e retornando o status da operação
try {
    $cliente->salvar($pdo);
    echo json_encode(['status' => 'sucesso']);
} catch (RuntimeException $e) {
    echo json_encode(['status' => 'erro', 'mensagem' => $e->getMessage()]);
}
?>