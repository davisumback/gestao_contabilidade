<?php
namespace App\Login;

use App\Helper\Helpers;

class FranqueadoLogin
{
    public function tentaRealizarLogin($attributes)
    {
        $dao = new \App\DAO\FranqueadoDAO();
        $franqueado = $dao->tentaRealizarLoginFranqueado(Helpers::formataCpfBd($attributes['usuario']), $attributes['senha'], 'MEDCONTABIL');
        $session = $this->logaFranqueado($franqueado['usuario'], $franqueado['nome_completo'], $franqueado['id'], $franqueado['avatar'], $franqueado['pasta']);

        return $session;
    }

    public function logaFranqueado($nomeUsuario, $nomeCompleto, $id, $avatar, $pasta)
    {
        session_start();

        $diaPadrao = '01';
        $dataCompetenciaFormatada = new \DateTime();
        $dataCompetenciaFormatada->modify('-1 month');
        $dataCompetencia = $dataCompetenciaFormatada->format('Y-m');
        $dataCompetencia .= '-' . $diaPadrao;

        $dataCompetenciaViewFormatada = new \DateTime();
        $dataCompetenciaViewFormatada->modify('-1 month');
        $dataCompetenciaView = $dataCompetenciaViewFormatada->format('m/Y');

        $_SESSION['usuario'] = $nomeUsuario;
        $_SESSION['nome_completo'] = $nomeCompleto;
        $_SESSION['id_usuario'] = $id;
        $_SESSION['avatar'] = $avatar;
        $_SESSION['pasta'] = $pasta;
        $_SESSION['dataCompetencia'] = $dataCompetencia;
        $_SESSION['dataCompetenciaView'] = $dataCompetenciaView;
        $_SESSION['diaPadraoCompetencia'] = '01';

        return $_SESSION;
    }

    public function logout()
    {
        unset($_SESSION);
        setcookie('PHPSESSID', null, -1, '/');
        session_destroy();
    }
}