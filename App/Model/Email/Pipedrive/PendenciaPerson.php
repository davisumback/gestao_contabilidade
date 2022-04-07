<?php
namespace App\Model\Email\Pipedrive;

use App\Html\Email\Pipedrive\PersonCampos;
use App\Email\EnviaEmail;

class PendenciaPerson
{
    private $userName;
    private $userEmail;
    private $personName;
    private $personCamposVazios;

    public function __construct($userName, $userEmail, $personName, $personCamposVazios)
    {
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->personName = $personName;
        $this->personCamposVazios = $personCamposVazios;
    }

    public function enviaEmailPendencias()
    {
        $personCampos = new PersonCampos();
        $corpoEmail = $personCampos->getCorpoEmail();

        $htmlCamposVazios = '';
        foreach ($this->personCamposVazios as $chave => $valor) {
            $htmlCamposVazios .= '<tr>
                                    <td class="td-conteudo-texto" style="font-size:1.5em;color:#003313;text-indent:30px;text-align:justify;padding:0 50px;">';
            $htmlCamposVazios .= strtoupper(str_replace('_', ' ', $chave)) . ' - ' . $valor;
            $htmlCamposVazios .= '    </td>
                                </tr>';
        }

        $corpoEmail = str_replace('{{user}}', $this->userName, $corpoEmail);
        $corpoEmail = str_replace('{{person}}', $this->personName, $corpoEmail);
        $corpoEmail = str_replace('{{camposPendentes}}', $htmlCamposVazios, $corpoEmail);

        // $retornoEmail = EnviaEmail::send($this->userEmail, $this->userName, 'Pendências | Cadastro Cliente', $corpoEmail);
        $retornoEmail = EnviaEmail::send('tthiagogaia@gmail.com', $this->userName, 'Pendências | Cadastro Cliente', $corpoEmail);

        return $retornoEmail;
    }
}
