<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizadorHtmlTrait;

class ListarCursos implements InterfaceControladorRequisicao
{
    use RenderizadorHtmlTrait;

    private $repositorioDeCursos;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())
            ->getEntityManager();
        $this->repositorioDeCursos = $entityManager
            ->getRepository(Curso::class); 
    }

    public function processaRequisicao() : void
    {   
        $cursos = $this->repositorioDeCursos->findAll();
        echo $this->renderizaHtml('cursos/listar-cursos.php', [
        'cursos' => $cursos,
        'titulo' => 'Lista de Cursos'
        ]);         
    }
}