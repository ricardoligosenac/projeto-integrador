<?php
require_once "topo.php";
require_once "classes/Cliente.php";

$pdo = conectarPDO();
$cliente = new Cliente();
$res = $cliente->listar($pdo)
?>

<div class="pagina">
    <h1 class="tituloPagina">Clientes</h1>

    <div class="cabecalhoPagina">
        <form action="clientes" method="get">
            <div class="filtros">
                <input type="text" name="filtroNome" class="campoTexto" id="filtroNome" placeholder="Filtrar por nome">
                <input type="submit" class="botao" value="Aplicar filtros">
            </div>
        </form>
        <input type="button" class="botao" style="background:var(--verde)" value="Adicionar cliente" onclick="window.location.href='cliente-adicionar'">
    </div>

    <div class="lista">
        <div class="cabecalhoLista">
            <div>Nome</div>
            <div>Contato</div>
            <div>Data de nascimento</div>
            <div>Detalhes</div>
        </div>
        <div class="listagem">
            <?php foreach ($res as list($id,$nome, $telefone, $dataNascimento)): ?>
                <div class="item">
                    <div><?= $nome ?></div>
                    <div><?= $telefone; ?></div>
                    <div><?= $dataNascimento; ?></div>
                    <div><img src="assets/img/lupa.svg" alt=""></div>
                    <div class="detalhesMobile"><img src="assets/img/lupa.svg" alt=""></div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
<?php require_once "rodape.php"; ?>