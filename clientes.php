<?php
require_once "topo.php";
require_once "classes/Cliente.php";

$filtroNome = $_GET['filtroNome'] ?? '';

$pdo = conectarPDO();
$cliente = new Cliente();
$res = $cliente->listar($pdo, $filtroNome);
?>

<div class="pagina">
    <h1 class="tituloPagina">Clientes</h1>

    <div class="cabecalhoPagina">
        <form action="clientes" method="get">
            <div class="filtros">
                <input type="text" name="filtroNome" class="campoTexto" id="filtroNome" placeholder="Filtrar por nome" value="<?= $filtroNome ?>">
                <input type="submit" class="botao" value="Aplicar filtros">
            </div>
        </form>
        <input type="button" class="botao" style="background:var(--verde)" value="Adicionar cliente" onclick="window.location.href='cliente-adicionar'">
    </div>

    <div class="lista">
        <div class="cabecalhoLista">
            <div>Nome</div>
            <div>E-mail</div>
            <div>Telefone</div>
            <div>Detalhes</div>
        </div>
        <div class="listagem">
            <?php foreach ($res as list($id,$nome, $telefone, $dataNascimento)): ?>
                <div class="item">
                    <div><?= $nome ?></div>
                    <div><?= $telefone ?></div>
                    <div><?= $dataNascimento ?></div>
                    <div class="detalhes" onclick="window.location.href='cliente-adicionar?id=<?= $id ?>'"><img src="assets/img/lupa.svg" alt=""></div>
                    <div class="detalhesMobile" onclick="window.location.href='cliente-adicionar?id=<?= $id ?>'"><img src="assets/img/lupa.svg" alt=""></div>
                </div>
            <?php endforeach ?>
                <div class="item vazio">Ops! Não foi encontrado nenhum resultado.</div>
        </div>
    </div>
</div>
<?php require_once "rodape.php"; ?>