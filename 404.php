<?php
require_once "config/config.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página não encontrada</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/estilo.css">
    <script src="assets/js/jquery-4.0.0.min.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</head>
<body id="body404">
    <div class="bloco404">
        <h1>Página não encontrada</h1>
        <div class="logo">
            <img src="assets/img/lua_cosmica.png">
        </div>
        <div class="bloco">
            Ops! Página não encontrada. Clique no botão abaixo para voltar para a tela inicial.
        </div>
        <div class="bloco">
            <input type="submit" class="botao" value="Voltar" onclick="window.location.href='<?= $urlBase ?>'">
        </div>
    </div>
</body>
</html>