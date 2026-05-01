<?php
// Aqui definimos uns parâmetros básicos de timezone e autoload para as classes
date_default_timezone_set('America/Sao_Paulo');
spl_autoload_register(function($classe) {
    require_once __DIR__ . '/classes/' . $classe . '.php';
});

// Definindo a URL base do projeto para facilitar redirecionamentos
$urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/projeto-integrador/';