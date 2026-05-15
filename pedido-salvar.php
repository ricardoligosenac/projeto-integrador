<?php
require_once "config/config.php";
require_once "verifica-logado.php";

// Pegando os dados do formulário de cliente

$cliente = isset($_POST['cliente']) ? trim($_POST['cliente']) : die(json_encode(['status' => 'erro', 'mensagem' => 'Cliente é obrigatório.']));
$descricoes = $_POST['descricaoProduto'];
$valores = $_POST['valorProduto'];


// Enviando os dados do pedido para salvar no banco de dados
$pdo = conectarPDO();
$pedido = new Pedido();

try {
    $pedido->salvar($pdo, $cliente, $descricoes, $valores);
    echo json_encode(['status' => 'sucesso']);
} catch (RuntimeException $e) {
    echo json_encode(['status' => 'erro', 'mensagem' => $e->getMessage()]);
}
?>