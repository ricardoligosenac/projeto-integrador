<?php
require_once "config/config.php";
$obj = new Login();

if (!$obj->estaLogado()) {
    header("Location:" . $urlBase);
    exit;
}
?>