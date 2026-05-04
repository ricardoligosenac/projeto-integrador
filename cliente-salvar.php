<?php
require_once "config/config.php";
require_once "verifica-logado.php";

// Pegando os dados do formulário de cliente
$nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : '';
$dataNascimento = isset($_POST['dataNascimento']) ? trim($_POST['dataNascimento']) : '';
$cep = isset($_POST['cep']) ? trim($_POST['cep']) : '';
$uf = isset($_POST['uf']) ? trim($_POST['uf']) : '';
$cidade = isset($_POST['cidade']) ? trim($_POST['cidade']) : '';
$bairro = isset($_POST['bairro']) ? trim($_POST['bairro']) : '';
$logradouro = isset($_POST['logradouro']) ? trim($_POST['logradouro']) : '';
$numero = isset($_POST['numero']) ? trim($_POST['numero']) : '';

// Enviando os dados para a classe de cliente para salvar
$pdo = conectarPDO();
$cliente = new Cliente();

// Validando se os dados estão corretos e atribuindo os valores à classe.
try {
    $cliente->setDados($nome, $email, $telefone, $dataNascimento, $cep, $uf, $cidade, $bairro, $logradouro, $numero);
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