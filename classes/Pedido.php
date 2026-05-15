<?php
class Pedido
{

    public function salvar(PDO $pdo, string $clienteId, array $descricoes, array $valores)
    {
        try {
            $pdo->beginTransaction();

            // Montando o array e json dos itens
            $itens = [];
            $totalPedido = 0;
            for ($i = 0; $i < count($descricoes); $i++) {

                // Pegando os dados e formatando o valor para salvar no banco
                $descricao = trim($descricoes[$i]);
                $valor = str_replace(',', '.', str_replace('.', '', trim($valores[$i])));

                // Estando preenchidos, adicionamos no array e somamos no total
                if (!empty($descricao) && is_numeric($valor)) {
                    $itens[] = ['descricao' => $descricao, 'valor' => number_format($valor, 2, '.', '')];
                    $totalPedido += $valor;
                }
            }

            $jsonItens = json_encode($itens);

            // Inserindo o pedido
            $sql = "INSERT INTO pedidos (cliente_id, data_criacao, pedido, total) VALUES (:clienteId, :dataCriacao, :pedido, :total)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':clienteId' => $clienteId, ':pedido' => $jsonItens, ':total' => $totalPedido, ':dataCriacao' => date('Y-m-d H:i:s')]);
            $pdo->commit();
            return ['status' => 'sucesso'];
        } catch (Exception $e) {

            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }

            throw new RuntimeException("Erro ao salvar o pedido: " . $e->getMessage());
        }
    }

    public function listar(PDO $pdo, $filtroNome = null)
    {
        try {

            $filtros = "";
            if (!empty($filtroNome)) {
                $filtros .= "WHERE c.nome LIKE :filtroNome";
            }

            $sql = "SELECT p.id, c.nome AS cliente_nome, p.data_criacao, p.pedido, p.total
                    FROM pedidos p
                    JOIN clientes c ON p.cliente_id = c.id
                    $filtros
                    ORDER BY p.data_criacao DESC";
            $stmt = $pdo->prepare($sql);

            if (!empty($filtroNome)) {
                $stmt->bindValue(':filtroNome', '%' . $filtroNome . '%');
            }

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $e) {
            throw new RuntimeException("Erro ao listar os pedidos: " . $e->getMessage());
        }
    }
}
