<?php
namespace App\Controller;

use App\Model\Inconsistencia\EmpresaCadastroInconsistencia;
use App\View\Inconsistencia\InconsistenciaView;

class InconsistenciaController
{
    private $params;

    public function __construct($request, $params = null)
    {
        $this->pararams = $params;
        $this->$request();
    }

    public function all()
    {
        $inconsistencias = new EmpresaCadastroInconsistencia();
        $todasInconsistencias = $inconsistencias->getAll('WHERE status = "PENDENTE"');

        $view = new InconsistenciaView();
        $view->showAll($todasInconsistencias);
    }
}
