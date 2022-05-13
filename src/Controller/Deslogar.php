<?php

namespace Alura\Cursos\Controller;

class Deslogar implements InterfaceControladorRequisicao
{
    public function processaRequisicao(): void
    {
        session_destroy(); //irá encerrar a sessão 'logado' do usuário
        header('Location: /login');
    }
}