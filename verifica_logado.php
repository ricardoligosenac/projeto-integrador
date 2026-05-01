<?php
require "config.php";
$obj = new Login();

if (!$obj->estaLogado()) {
    header("Location:" . $urlBase);
    exit;
}
?>