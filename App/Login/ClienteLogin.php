<?php
namespace App\Login;

use App\Helper\Helpers;
use App\Model\Usuario\Cliente;

class ClienteLogin
{
    public function tentaRealizarLogin(Cliente $cliente)
    {
        $cliente = $cliente->isLogin();
        $session = $this->logaCliente($cliente);

        return $session;
    }

    public function logaCliente($cliente)
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
        
        $_SESSION['nome_completo'] = $cliente['nome_completo'];
        $_SESSION['regime_tributario'] = $cliente['regime_tributario'];
        $_SESSION['id_usuario'] = $cliente['id'];
        $_SESSION['empresasId'] = $cliente['empresasId'];
        $_SESSION['pasta'] =  $cliente['pasta'];
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