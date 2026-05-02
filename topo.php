<?php
require_once "config.php";
require_once "verifica-logado.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NomeSistema</title>
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