<?php
namespace App\Model;

class Irpf 
{
    private $clientes;

    private $configuracoes = [
        'HOST' => 'smtpi.kinghost.net',
        'USER_NAME' => 'irpf@medb.com.br',
        'SENHA' => 'franquia01',
        'TITULO_EMAIL' => 'Medb | IRPF',
        'NOME_EMAIL_DE_RESPOSTA' => 'IRPF'
    ];   

    public function __construct($clientes)
    {
        $this->clientes = $clientes;
    }

    public function enviaEmail()
    {
        $html = file_get_contents('../../sistema/views/email/campanha/irpf-2018.php');
        $item = '';

        foreach ($this->clientes as $chave => $valorArray) {
            $nomeCompleto = explode(' ', $valorArray['nome']);
            $corpoEmail = str_replace('{{nomeCliente}}', $nomeCompleto[0], $html);
            
            foreach ($valorArray as $chaveArray2 => $valor) {
                if ($valor === 'SIM') {
                    $item .= '<div style="text-align: justify;color: #09814a; margin-top:7px; text-indent:20px;">';
                    $item .= $this->adicionaItemIrpf($chaveArray2);
                    $item .= '</div>';
                }
            }

            $corpoEmail = str_replace('{{itensIrpf}}', $item, $corpoEmail);
            $item = '';

            $retornoEmail = \App\Email\EnviaEmailDefault::send($this->configuracoes, $valorArray['email_cliente'], $valorArray['nome'], 'Imposto de Renda: Documentos Necessários', $corpoEmail, 'irpf@medb.com.br');
            
            if ($retornoEmail == true) {
                $dao = new \App\DAO\EmailMarketingCampanhaDAO();
                $dao->updateEmails($valorArray['clientes_id'], $valorArray['campanha']);
            }
        }
    }

    public function adicionaItemIrpf($escolha)
    {
        switch ($escolha) {
            case 'trabalhou_pf':
                return '- Informes de rendimentos das fontes pagadoras (fornecidos pela empresa onde foi prestado o serviço) e recibos emitidos de serviços prestados. Caso tenha trabalhado por RPA, solicitamos o informe de rendimento (fornecidos pela empresa onde foi prestado o serviço).';
                break;

            case 'recibo_pf':
                return '- Recibos emitidos aos pacientes.';
                break;

            case 'obteve_recebimentos':
                return '- Informe de rendimentos de bolsa residência ou do Programa Mais Médicos.';
                break;

            case 'possui_imovel':
                return '- Contrato de compra e matrícula do imóvel.';
                break;

            case 'possui_veiculo':
                return '- Nota fiscal de compra ou recibo do veículo com os dados do vendedor e valor.';
                break;

            case 'proprietario_consorcio':
                return '- Contrato e informe de rendimento de consórcio.';
                break;

            case 'renda_rural':
                return '- Arquivo do contador rural ou as despesas e faturamentos obtidos durante o ano.';
                break;

            case 'ganho_capital':
                return '- Guia do imposto pago sob ganho de capital.';
                break;

            case 'heranca':
                return '- Documento que comprove recebimento de herança.';
                break;

            case 'pensao':
                return '- Enviar decisão judicial para o pagamento ou recebimento de pensão alimentícia.';
                break;

            case 'aluguel':
                return '- Declaração de Informações sobre Atividades Imobiliárias (Dimob) ou os recibos do ano e informar caso tenha havido retenção de IR aos pagamentos recebidos.';
            break;
        }
    }
}