<?php
require "config.php";

// Finaliza a sessão do usuário e redireciona para a página de login
session_start();
session_destroy();
header("Location: " . $urlBase);