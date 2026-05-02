<?php
require_once "topo.php";
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
            <?php for ($i = 0; $i < 10; $i++): ?>
                <div class="item">
                    <div>Nome de Teste</div>
                    <div>(19) 9 9999-9999</div>
                    <div>10/10/2026</div>
                    <div><img src="assets/img/lupa.svg" alt=""></div>
                    <div class="detalhesMobile"><img src="assets/img/lupa.svg" alt=""></div>
                </div>
            <?php endfor ?>
        </div>
    </div>
</div>
<?php require_once "rodape.php"; ?>