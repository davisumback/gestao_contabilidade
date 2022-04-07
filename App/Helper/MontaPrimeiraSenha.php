<?php

namespace App\Helper;

class MontaPrimeiraSenha{
    private $nome;
    private $nascimento;
    private $cpf;

    function __construct($nome, $nascimento, $cpf){
        $this->nome = $nome;
        $this->nascimento = $nascimento;
        $this->cpf = $cpf;
    }

    function montaPrimeiraSenha(){
        $senha = substr($this->nascimento, 0, 2) . '@@' . substr($this->cpf, 0, 3);

        $saida = '<html>
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
                                color: #9E9E9E;
                                text-indent: 10px;
                                line-height: 2.0em;
                                text-align: justify;
                            }
                            .usuario{
                                padding: 0 30px;
                                color: #9E9E9E;
                                text-indent: 10px;
                                line-height: 0.1em;
                                text-align: justify;
                            }
                            h4{
                                margin-bottom: 0 !important;
                                padding-top: 0 !important;
                            }
                            .div-botao{
                                text-align: center;
                            }
                            .aceitar{
                                margin-top: 30px;
                                display: inline-block;
                                background-color: #388E3C;
                                border-radius: 5px;
                                padding: 10px;
                                cursor: pointer;
                            }
                            .aceitar a{
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
                                    <h3 class="titulo" style="color: #757575;text-align: left;font-weight: bold;">Olá,</h3>
                                    <h3 class="titulo" style="color: #757575;text-align: left;font-weight: bold;">'."$this->nome".'</h3>
                                    <p class="conteudo" style="padding: 0 30px;color: #9E9E9E;text-indent: 10px;line-height: 2.0em;text-align: justify;">É com grande satisfação que o recebemos como nosso cliente!</p>
                                    <p class="conteudo" style="padding: 0 30px;color: #9E9E9E;text-indent: 10px;line-height: 2.0em;text-align: justify;">Seguem os dados para o seu primeiro acesso.</p>
                                    <h4 class="conteudo" style="padding: 0 30px;color: #9E9E9E;text-indent: 10px;line-height: 2.0em;text-align: justify;margin-bottom: 0 !important;padding-top: 0 !important;">Usuário:</h4>
                                    <p class="usuario" style="padding: 0 30px;color: #9E9E9E;text-indent: 10px;line-height: 0.1em;text-align: justify;">'."$this->cpf".'</p>
                                    <h4 class="conteudo" style="padding: 0 30px;color: #9E9E9E;text-indent: 10px;line-height: 2.0em;text-align: justify;margin-bottom: 0 !important;padding-top: 0 !important;">Senha:</h4>
                                    <p class="usuario" style="padding: 0 30px;color: #9E9E9E;text-indent: 10px;line-height: 0.1em;text-align: justify;">'."$senha".'</p>
                                </td>
                            </tr>
                            <tr class="div-botao" style="text-align: center;margin-top:30px;margin-bottom:30px;">
                                <td class="aceitar" style="margin-top: 30px;display: inline-block;background-color: #388E3C;border-radius: 5px;padding: 10px;cursor: pointer;"><a href="https://www.google.com.br" style="text-decoration: none;color: white;">Acessar</a></td>
                            </tr>
                        </table>

                    </body>
                    </html>
                ';

        return $saida;
    }
}
