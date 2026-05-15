<?php
require_once "topo.php";

$obj = new Cliente();
$pdo = conectarPDO();
$clientes = $obj->listar($pdo);
?>
<div class="pagina">
    <h1 class="tituloPagina">Adicionar pedido</h1>

    <div class="cabecalhoPagina">
        <input type="button" class="botao" value="Voltar" onclick="window.location.href='pedidos'">
    </div>

    <form id="formPedidoAdicionar" action="javascript:salvarPedido()">
        <div class="formulario">
            <div class="formDiv">
                <div class="labelInput">
                    <label for="cliente">Cliente *</label>
                    <select name="cliente" id="cliente" class="campoTexto">
                        <option value="" hidden>Selecione um cliente</option>
                        <?php foreach ($clientes as list($id, $nome)): ?>
                            <option value="<?= $id ?>"><?= $nome ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="formDiv">
                <div class="labelInput">
                    <label for="descricao">Preencha o pedido</label>
                    <!-- <textarea name="descricao" id="descricao" class="campoTexto" style="resize:none; height:160px"></textarea> -->
                     <div class="itemProduto">
                        <input type="text" class="campoTexto" name="descricaoProduto[]" placeholder="Digite o produto">
                        <input type="text" class="campoTexto campoValor" name="valorProduto[]" placeholder="Digite o valor">
                        <input type="button" value="+" class="botaoAdicionarProduto" onclick="adicionarProduto(this)">
                     </div>
                </div>
            </div>
            <div class="formDiv alinharDireita">
                <input type="submit" class="botao" style="background:var(--verde)" id="botaoSalvar" value="Salvar">
            </div>
        </div>
    </form>
</div>

<style>
    .itemProduto {
        display: flex;
        gap: 10px;
        margin-bottom: 8px;
    }

    .itemProduto input:nth-child(2) {
        width: 150px;
    }

    .botaoAdicionarProduto {
        width: 40px;
        height: 40px;
        font-size: 24px;
        line-height: 0;
        padding: 0;
        border:0px;
        border-radius:4px;
        background:var(--verde);
        color:#fff;
    }
</style>

<script>
    // Máscara para o valor total
    document.querySelectorAll('.campoValor').forEach(function(element) {
        element.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            value = (value / 100).toFixed(2) + '';
            value = value.replace('.', ',');
            e.target.value = value;
        });
    });
</script>

<?php require_once "rodape.php"; ?>