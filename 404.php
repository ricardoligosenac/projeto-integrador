<?php
require "config.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página não encontrada</title>
    <link rel="stylesheet" href="js_css/bootstrap.min.css">
    <link rel="stylesheet" href="js_css/jquery-ui.min.css">
    <link rel="stylesheet" href="js_css/estilo.css">
    <script src="js_css/jquery-4.0.0.min.js"></script>
    <script src="js_css/jquery-ui.min.js"></script>
    <script src="js_css/scripts.js"></script>
</head>
<body id="body404">
    <div class="bloco404">
        <h1>Página não encontrada</h1>
        <div class="logo">
            <img src="imagens/lua_cosmica.png">
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