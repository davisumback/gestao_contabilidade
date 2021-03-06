<?php

namespace App\Email;

use App\Helper\Helpers;

class TemplateEmailSn{
    private $nomeCliente;
    private $guias;

    public function __construct($nomeCliente, $guias = '')
    {
        $this->nomeCliente = $nomeCliente;
        $this->guias = $guias;
    }

    public function getCorpoEmail()
    {
        $saida = '<!DOCTYPE html>
        <html lang="pt-br" dir="ltr">
            <head>
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
                <style type="text/css">
                    body{
                        margin: 0;
                        padding: 0;
                    }
                    .main-table{
                        width: 100%;
                        background-color: #E8F5E9;
                    }
                    .head-table{
                        width: 1200px;
                        background-color: #ffffff;
                        border-collapse: collapse;
                    }
                    .head-td-imagem{
                        background-color: #C8E6C9;
                        padding: 70px 100px 70px 0;
                        background-image: url(\'https://www.medb.com.br/public/img-email/banner_site.jpg\');
                        background-size: 1200px;
                        background-repeat: no-repeat;
                        background-position: center;
                    }
                    .head-imagem{
                        width: 300px;
                        display: block;
                    }
                    .td-altura-min{
                        min-height: 600px;
                    }
                    .footer-td-imagem{
                        padding: 15px 0 50px 0;
                        background-image: url(\'https://www.medb.com.br/public/img-email/fundo-plano.jpg\');
                        background-size: 1350px;
                        background-repeat: no-repeat;
                        background-position: center;
                    }
                    .footer-table{
                        width: 100%;
                    }
                    .td-titulo-redes{
                        padding: 50px 0 30px 10px;
                        font-family: sans-serif;
                        font-weight: bold;
                        font-size: 25px;
                        color: #003313;
                    }
                    .td-conteudo-texto{
                        text-indent:30px;
                        text-align:justify;
                        padding:0 0 20px 0;
                    }
                    .td-button{
                        padding: 0 0 50px 50px;
                    }
                    .botao{
                        height: 70px;
                        width: 70px;
                        background-color: #018245;
                        border-radius: 50%;
                        border-style: none;
                        display: inline-block;
                        text-align: center;
                    }
                    .icones-botao{
                        color: #ffffff;
                        font-size: 40px;
                        padding-top: 14px;
                    }
                    .td-logo-assinatura{
                        padding: 20px 20px 10px 0;
                    }
                    .logo-assinatura{
                        width: 130px;
                    }
                    .barra-assinatura{
                        background-color: #003313;
                    }
                    .texto-assinatura{
                        padding: 0 0 0 10px;
                        font-family: sans-serif;
                        font-weight: bold;
                        font-size: 18px;
                        color: #003313;
                    }
                </style>

                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <title>Medb | Contabilidade e Finan??as</title>
            </head>

            <body style="font-family: \'Roboto\', sans-serif;margin: 0;padding: 0;">
                <table border="0" cellpadding="0" cellspacing="0" class="main-table" style="width: 100%;background-color: #E8F5E9;">
                    <tr>
                        <td>
                            <table align="center" border="0" cellpadding="0" cellspacing="0" class="head-table" style="min-height:1000px;width:1200px;background-color:#ffffff;border-collapse: collapse;">
                                <tr>
                                    <td align="right" class="head-td-imagem" style="height:100px;background-color: #C8E6C9;padding: 70px 100px 70px 0;background-image: url(https://www.medb.com.br/public/img-email/banner_site.jpg);background-size: 1200px;background-repeat: no-repeat;background-position: center;">
                                        <img src="https://www.medb.com.br/public/img-email/logo-medb.png" alt="Medb" class="head-imagem" style="width: 300px;display: block;">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td-conteudo-texto" style="font-size:1.5em;color:#003313;text-indent:30px;text-align:justify;padding:0 50px;">
                                        Ol?? '.$this->nomeCliente.', este ?? um email autom??tico gerado pelo nosso Sistema. =)
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td-conteudo-texto" style="font-size:1.5em;color:#003313;text-indent:30px;text-align:justify;padding: 0 50px;">
                                        Estamos lhe enviando em anexo as guias para pagamento. Qualquer d??vida, por favor, n??o hesite em entrar em contato
                                        conosco. Sua gestora j?? est?? em c??pia no e-mail.
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td-conteudo-texto" style="font-size:1.5em;color:#003313;text-indent:30px;text-align:justify;padding: 0 50px;">
                                        Por favor, atente-se que um arquivo pode conter duas guias.
                                    </td>
                                </tr>';

                                $htmlGuias = '';
                                foreach ($this->guias as $guia) {
                                    $guia['tipo'] = ($guia['tipo'] == 'HONORARIOS') ? 'HONOR??RIOS' : $guia['tipo'];
                                    $nomeGuiasFormatado = Helpers::formataNomeGuiaEmail($guia['nome_guia']);
                                    $mesmoAnexoFormatado = Helpers::formataObservacaoMesmoAnexo($nomeGuiasFormatado);

                                    $htmlGuias .= '<tr>
                                                    <td class="td-conteudo-texto" style="font-size:1.5em;color:#003313;text-indent:30px;text-align:justify;padding: 0 50px;">'
                                                        . $nomeGuiasFormatado . ' vencimento: ' . Helpers::formataDataView($guia['data_vencimento']) . '<strong> ' .$mesmoAnexoFormatado .
                                                        '</strong>
                                                    </td>
                                                    </tr>';
                                }

                                $saida = $saida . $htmlGuias;

                                $saida .= '<tr><td class="td-conteudo-texto" style="font-size:1.5em;color:#003313;text-indent:30px;text-align:justify;padding: 0 50px;"></td></tr>
                                <tr><td class="td-conteudo-texto" style="font-size:1.5em;color:#003313;text-indent:30px;text-align:justify;padding: 0 50px;"></td></tr>
                                <tr><td class="td-conteudo-texto" style="font-size:1.5em;color:#003313;text-indent:30px;text-align:justify;padding: 0 50px;"></td></tr>
                                <tr><td class="td-conteudo-texto" style="font-size:1.5em;color:#003313;text-indent:30px;text-align:justify;padding: 0 50px;"></td></tr>
                                <tr><td class="td-conteudo-texto" style="font-size:1.5em;color:#003313;text-indent:30px;text-align:justify;padding: 0 50px;"></td></tr>
                                <tr><td class="td-conteudo-texto" style="font-size:1.5em;color:#003313;text-indent:30px;text-align:justify;padding: 0 50px;"></td></tr>
                                <tr>
                                    <td class="td-conteudo-texto" style="font-size:1.5em;color:#003313;text-indent:30px;text-align:justify;padding: 0 50px;">
                                        Att.
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td-conteudo-texto" style="font-size:1.5em;color:#003313;text-indent:30px;text-align:justify;padding: 0 50px;">
                                        MedB | Contabilidade e Finan??as
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
        </html>';

        return $saida;
    }
}
