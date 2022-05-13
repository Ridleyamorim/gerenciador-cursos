<?php

//fazer log de todas as requisições

require __DIR__ . '/../vendor/autoload.php'; // explicação: do diretório atual (__DIR__) subir um nível (/../).  

use Alura\Cursos\Controller\FormularioInsercao;
use Alura\Cursos\Controller\ListarCursos;
use Alura\Cursos\Controller\Persistencia;

$caminho = $_SERVER['PATH_INFO'];
$rotas = require __DIR__ . '/../config/routes.php';

if(!array_key_exists($caminho, $rotas)) {
    http_response_code(404);
    exit();
}

session_start();

$ehRotaLogin = stripos($caminho, 'login'); //retorna false se não há a palavra login nas strings
if (!isset($_SESSION['logado']) and $ehRotaLogin === false) {
    header('Location: /login');
}

$classecontroladora = $rotas[$caminho]; //o array associativo irá buscar o valor no arquivo routes.php
$controlador = new $classecontroladora();
$controlador->processaRequisicao();


//ABAIXO SERIA A VERSÃO MAIS EXTENSA DO QUE O CÓDIGO ACIMA FAZ.

/*switch ($_SERVER['PATH_INFO']) {
    case '/listar-cursos':
        $controlador = new ListarCursos();
        $controlador->processaRequisicao();
        break;
    case '/novo-curso':
        $controlador = new FormularioInsercao();
        $controlador->processaRequisicao();
        break;
    case '/salvar-curso':
        $controlador = new Persistencia();
        $controlador->processaRequisicao();
        break;
    default:
        echo 'Erro 404';
        break;
}*/ 
