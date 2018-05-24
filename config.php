<?php

require 'environment.php';

global $config;
$config = array();

if (ENVIRONMENT == 'development') {
    define("BASE", "http://localhost/swix-pro/");
    //define("BASEADMIN", "http://localhost/NOME_DA_PASTA_DO_PROJETO/App/admin/");
    $config['dbname'] = 'pl_swix';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
} else {
    define("BASE", "https://seudominio_real/");
    define("BASEADMIN", "https://seudominio_real/admin/");
    $config['dbname'] = 'dbname';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'user';
    $config['dbpass'] = 'password';
}

