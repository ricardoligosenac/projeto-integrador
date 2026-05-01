<?php
// Definindo timezone
date_default_timezone_set('America/Sao_Paulo');

// Função de autoload para carregar as classes automaticamente quando forem instanciadas
spl_autoload_register(function ($classe) {
    require_once __DIR__ . '/classes/' . $classe . '.php';
});

// Definindo a URL base do projeto para facilitar redirecionamentos
$urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/projeto-integrador/';

// Função para obter a conexão PDO com o banco de dados
function conectarPDO(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $pdo = new PDO(
            "mysql:host=sql103.byethost7.com;dbname=b7_41807396_proj_integrador;charset=utf8mb4",
            "b7_41807396",
            "SenhaProjeto453"
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    return $pdo;
}
?>