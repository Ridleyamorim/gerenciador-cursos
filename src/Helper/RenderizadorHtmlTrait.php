<?php

namespace Alura\Cursos\Helper;

trait RenderizadorHtmlTrait
{
    public function renderizaHtml(string $caminhoTemplate, array $dados) : string
    {
        extract($dados);
        ob_start(); // Out buffer 
        require __DIR__ . '/../../view/' . $caminhoTemplate; // nos outros controllers iremos ter os valores específicos do $caminhoTemplate
        $html = ob_get_clean();

        return $html;
    }    
}