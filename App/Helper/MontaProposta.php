<?php

namespace App\Helper;

class MontaProposta{
    private $titulo;
    private $corpo;
    private $link_aceite;
    private $link_rejeite;

    function __construct($titulo, $corpo){
        $this->titulo = $titulo;
        $this->corpo = $corpo;
    }

    function montaProposta(){
        $saida = '
            <html>
            <head>
                <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
                <style type="text/css">
                    body {
                        font-family: \'Roboto\', sans-serif;
                        background-color: #F1F4F9;
                    }
                    table {
                        margin-top: 50px;
                        max-width: 600px;
                        border-collapse: collapse;
                        margin-left:auto;
                        margin-right:auto;
                    }
                    .topo {
                        text-align:center;
                        background-color: #FAFAFA;
                        height: 150px;
                    }
                    .topo h1{
                        color: white;
                    }
                    .titulo {
                        color: #757575;
                        text-align:left;
                        font-weight: bold;
                    }
                    .meio {
                        padding: 20px;
                        background-color: #ffffff;
                        height: 250px;
                        vertical-align: text-top;
                    }
                    .conteudo{
                        padding: 0 30px;
                        text-indent: 40px;
                        color: #9E9E9E;
                        line-height: 2.0em;
                        text-align: justify;
                    }
                    .div-att{
                        padding-top: 40px !important;
                    }
                    .att{
                        padding: 0 30px;
                        color: #757575;
                        line-height: 0.8em;
                        text-align: justify;
                    }
                    .link-aceite{
                        text-align: center;
                    }
                    .aceitar{
                        display: inline-block;
                        background-color: #388E3C;
                        border-radius: 5px;
                        padding: 10px;
                        cursor: pointer;
                    }
                    .aceitar:hover{
                        background-color: #1B5E20;
                    }
                    .aceitar a{
                        text-decoration: none;
                        color: white;
                    }
                    .rejeitar{
                        margin-left: 20px;
                        display: inline-block;
                        background-color: #D32F2F;
                        border-radius: 5px;
                        padding: 10px;
                        cursor: pointer;
                    }
                    .rejeitar:hover{
                        background-color: #B71C1C;
                    }
                    .rejeitar a{
                        text-decoration: none;
                        color: white;
                    }


                </style>
            </head>

            <body style="font-family: \'Roboto\', sans-serif;background-color: #F1F4F9;">
                <table style="margin-top: 50px;max-width: 600px;border-collapse: collapse;margin-left: auto;margin-right: auto;">
                    <tr>
                        <td class="topo" style="text-align: center;background-color: #FAFAFA;height: 150px;">
                            <img src="http://www.grupobmw.com.br/medb/sistema/images/logo_medb.png" width="190">
                        </td>
                    </tr>
                    <tr>
                        <td class="meio" style="padding: 20px;background-color: #ffffff;height: 250px;vertical-align: text-top;">
                            <h3 class="titulo" style="color: #757575;text-align: left;font-weight: bold;">'."$this->titulo".'</h3>
                            <p class="conteudo" style="padding: 0 30px;text-indent: 40px;color: #9E9E9E;line-height: 2.0em;text-align: justify;">
                                '."$this->corpo".'
                            </p>
                            <h3 class="att div-att" style="padding: 0 30px;color: #757575;line-height: 0.8em;text-align: justify;padding-top: 40px !important;">Atenciosamente,</h3>
                            <h4 class="att" style="padding: 0 30px;color: #757575;line-height: 0.8em;text-align: justify;">Medb - Contabilidade e Finanças.</h4>
                        </td>
                    </tr>
                    <tr class="link-aceite" style="text-align: center; margin-top:30px;margin-bottom:30px;">
                        <td class="aceitar" style="display: inline-block;background-color: #388E3C;border-radius: 5px;padding: 10px;cursor: pointer;"><a href='."\"$this->link_aceite\"".' style="text-decoration: none;color: white;">Aceitar</a></td>
                        <td class="rejeitar" style="margin-left: 20px;display: inline-block;background-color: #D32F2F;border-radius: 5px;padding: 10px;cursor: pointer;"><a href='."\"$this->link_rejeite\"".' style="text-decoration: none;color: white;">Rejeitar</a></td>
                    </tr>
                </table>
            </body>
            </html>
        ';

        return $saida;
    }    

    public function setLinkAceite($link){
        $this->link_aceite = $link;
    }

    public function setLinkRejeite($link){
        $this->link_rejeite = $link;
    }
}
