<?php
require_once "config/config.php";
require_once "verifica-logado.php";

// Pegando os dados da requisição
$pedidoId = isset($_POST['pedidoId']) ? trim($_POST['pedidoId']) : die(json_encode(['status' => 'erro', 'mensagem' => 'ID do pedido é obrigatório.']));
$emAndamento = isset($_POST['emAndamento']) ? filter_var($_POST['emAndamento'], FILTER_VALIDATE_BOOLEAN) : die(json_encode(['status' => 'erro', 'mensagem' => 'Status do pedido é obrigatório.']));

// Atualizando o status do pedido
$pdo = conectarPDO();
$pedido = new Pedido();

try {
    $pedido->atualizarStatus($pdo, $pedidoId, $emAndamento);
    echo json_encode(['status' => 'sucesso', 'mensagem' => 'Status do pedido atualizado com sucesso.']);
} catch (RuntimeException $e) {
    echo json_encode(['status' => 'erro', 'mensagem' => $e->getMessage()]);
}
?>