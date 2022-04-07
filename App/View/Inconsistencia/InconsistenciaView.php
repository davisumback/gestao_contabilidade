<?php
namespace App\View\Inconsistencia;

class InconsistenciaView
{
    public function showAll($inconsistencias)
    {
        $linhas = '';
        $view = file_get_contents('../views/inconsistencia/index.php');

        foreach ($inconsistencias as $inconsistencia) {
            $statusInconsistencia = 'badge-success';

            if ($inconsistencia['status'] == 'PENDENTE') {
                $statusInconsistencia = 'badge-warning';
            }

            $linhas .= ' <tr class=\'text-center cursor-pointer\' onclick="vaiParaNovaPagina(\'../views/empresasIdSession.php?caminho=empresa-emails.php&empresasId='.$inconsistencia['empresas_id'].'&empresaNome='.$inconsistencia['nome_empresa'] .'\')">
                            <td><span class="badge badge-danger">' . $inconsistencia['prioridade'] . '</span></td>
                            <td>' . $inconsistencia['empresas_id'] . '</td>
                            <td>' . $inconsistencia['titulo'] . '</td>
                            <td>' . $inconsistencia['descricao'] . '</td>
                            <td><span class="badge '.$statusInconsistencia.'">' . $inconsistencia['status'] . '</td>
                        </tr>';
        }

        $view = str_replace('{{inconsistencias}}', $linhas, $view);

        echo $view;
    }
}
