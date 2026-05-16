<?php
require_once "topo.php";
require_once "classes/Cliente.php";

$filtroNome = $_GET['filtroNome'] ?? '';

$pdo = conectarPDO();
$cliente = new Pedido();
$res = $cliente->listar($pdo, $filtroNome);
?>

<div class="pagina">
    <h1 class="tituloPagina">Pedidos</h1>

    <div class="cabecalhoPagina">
        <form action="pedidos" method="get">
            <div class="filtros">
                <input type="text" name="filtroNome" class="campoTexto" id="filtroNome" placeholder="Filtrar por nome" value="<?= $filtroNome ?>">
                <input type="submit" class="botao" value="Aplicar filtros">
            </div>
        </form>
        <input type="button" class="botao" style="background:var(--azul-escuro)" value="Novo pedido" onclick="window.location.href='pedido-adicionar'">
    </div>

    <div class="lista">
        <div class="cabecalhoLista">
            <div>Nome</div>
            <div>Data do pedido</div>
            <div>Valor total</div>
            <div>Detalhes</div>
            <div>Em andamento</div>
        </div>
        <div class="listagem">
            <?php foreach ($res as list($id,$nome, $dataCriacao, $pedido, $totalPedido, $emAndamento)): ?>
                <div class="item">
                    <div><?= $nome ?></div>
                    <div><?= date('d/m/Y H:i', strtotime($dataCriacao)) ?></div>
                    <div>R$ <?= number_format($totalPedido, 2, ",", ".") ?></div>
                    <div class="detalhes" onclick='carregarModalDetalhesPedido(`<?= $nome ?>`, `<?= $dataCriacao ?>`, `<?= $totalPedido ?>`, `<?= $pedido ?>`)'><img src="assets/img/lupa.svg" alt=""></div>
                    <div onclick="carregarModalDetalhesPedido('<?= $nome ?>', '<?= $dataCriacao ?>', '<?= $totalPedido ?>', '<?= $pedido ?>')" class="detalhesMobile"><img src="assets/img/lupa.svg" alt=""></div>

                    <div>
                        <label class="switch">
                            <input type="checkbox" onchange="atualizarStatusPedido(<?= $id ?>, this.checked)" <?= $emAndamento == true ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    
                </div>
            <?php endforeach ?>
                <div class="item vazio">Ops! Não foi encontrado nenhum resultado.</div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDetalhes" tabindex="-1" aria-labelledby="modalDetalhesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetalhesLabel">Detalhes do pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="conteudoModalDetalhes">
                <div>
                    <span>Nome do cliente</span>
                    <span id="detalheNome"></span>
                </div>
                <div>
                    <span>Data do pedido</span>
                    <span id="detalheData"></span>
                </div>
                <div>
                    <span>Itens</span>
                    <ul id="detalheItens" style="margin:0;">
                    </ul>
                </div>
                <div>
                    <span>Valor total</span>
                    <span id="detalheValor"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="botao" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<?php require_once "rodape.php"; ?>