<?php
require_once "config.php";
require_once "verifica-logado.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NomeSistema - Clientes</title>
    <link rel="stylesheet" href="js_css/bootstrap.min.css">
    <link rel="stylesheet" href="js_css/jquery-ui.min.css">
    <link rel="stylesheet" href="js_css/estilo.css">
    <script src="js_css/jquery-4.0.0.min.js"></script>
    <script src="js_css/jquery-ui.min.js"></script>
    <script src="js_css/scripts.js"></script>
</head>

<body>
    <div class="topoSistema">
        <h1 class="tituloTopo">NomeSistema</h1>
        <ul>
            <li><a href="<?= $urlBase ?>clientes">Clientes</a></li>
            <li><a href="<?= $urlBase ?>produtos">Produtos</a></li>
            <li><a href="<?= $urlBase ?>pedidos">Pedidos</a></li>
            <li><a href="<?= $urlBase ?>sair">Sair</a></li>
        </ul>
    </div>
    <div id="paginaClientes">
        <h1 class="tituloPagina">Clientes</h1>

        <div class="cabecalhoPagina">
            <div class="filtros">
                <input type="text" class="campoTexto" id="filtroNome" placeholder="Filtrar por nome">
                <input type="date" class="campoTexto" id="filtroData" placeholder="Filtrar por data">
            </div>
            <input type="button" class="botao" value="Adicionar cliente">
        </div>

        <div class="listaClientes">
            <div class="cabecalhoLista">
                <div>Data de compra</div>
                <div>Nome</div>
                <div>Contato</div>
                <div>Detalhes</div>
            </div>
            <div class="listagem">
                <?php for ($i = 0; $i < 10; $i++): ?>
                    <div class="cliente">
                        <div>10/10/2026</div>
                        <div>Nome de Teste</div>
                        <div>(19) 9 9999-9999</div>
                        <div><img src="imagens/lupa.svg" alt=""></div>
                        <div class="detalhesMobile"><img src="imagens/lupa.svg" alt=""></div>
                    </div>
                <?php endfor ?>
            </div>

        </div>
    </div>

    <div class="modal">
            <div class="modalConteudo">
                <h2>Detalhes do cliente</h2>
                <p><strong>Nome:</strong> Nome de Teste</p>
                <p><strong>Data de compra:</strong> 10/10/2026</p>
                <p><strong>Contato:</strong> (19) 9 9999-9999</p>
                <p><strong>Endereço:</strong> Rua Exemplo, 123 - Cidade, Estado</p>
                <button class="botao" onclick="$('.modal').hide()">Fechar</button>
            </div>
    </div>

</body>

</html>

<style>
    #paginaClientes {
        padding: 20px;
    }

    #paginaClientes .tituloPagina {
        margin: 40px;
        text-align:center;
    }

    .cabecalhoPagina {
        display:flex;
        align-items:center;
        justify-content: space-between;
        margin-bottom:20px;
    }

    .filtros {
        display: flex;
        gap: 10px;
    }

    .listaClientes {
        border: 1px solid #ccc;
        border-radius: 5px;
        overflow: hidden;
    }

    .cabecalhoLista {
        display: flex;
        background: #f0f0f0;
        padding: 10px;
        font-weight: bold;
        border-bottom:1px solid #ccc;
    }

    .cabecalhoLista>div {
        flex: 1;
    }

    .cliente:first-child {
        border-top: none;
    }

    .cliente {
        display: flex;
        padding: 10px;
        border-top: 1px solid #ccc;
        align-items: center;
        position: relative;
    }

    .cliente>div {
        flex: 1;
    }

    .listagem .cliente div, .cabecalhoLista div {
        text-align:center;
    }

    .cliente .detalhesMobile {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        display: none;
        width: auto
    }

    /* Responsivo */
    @media (max-width: 600px) {

        .cabecalhoPagina {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .botao {
            width:100%;
        }

        .cabecalhoLista {
            display: none;
        }

        .cliente {
            flex-direction: column;
            align-items: flex-start;
        }

        .listagem .cliente div {
            text-align:justify;
            max-width:calc(100% - 40px);
        }

        .cliente>div {
            flex: none;
            width: 100%;
        }

        .cliente>div:nth-child(4) {
            display: none;
        }

        .cliente .detalhesMobile {
            display: block;
        }
    }
</style>