<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizadorHtmlTrait;

class FormularioEdicao implements InterfaceControladorRequisicao
{
    use RenderizadorHtmlTrait;

    private $entityManager;
    private $repositorioCursos;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioCursos = $this->entityManager->getRepository(Curso::class);
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if (is_null($id) or $id === false) {
            header('Location: /listar-cursos');
            return;
        }
        $curso = $this->repositorioCursos->find($id);
        echo $this->renderizaHtml('cursos/formulario.php', [
            'curso' => $curso,
            'titulo' => 'Alterar curso de ' . $curso->getDescricao()
        ]);
    }
}