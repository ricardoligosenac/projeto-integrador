<?php
require_once "config.php";

// O index orquestra. Se o usuário já estiver logado, redireciona para a página de clientes, se não, redireciona para a página de login
$obj = new Login();

if ($obj->estaLogado()) {
    header("Location: clientes");
} else {
    header("Location: login");
}
?>