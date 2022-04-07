<?php
namespace App\Model\Faturamento;

use App\DAO\FaturamentoDAO;
use App\Helper\Helpers;

class Faturamento
{
	private $meses;

	public function setFaturamentoMes($mes)
	{
		$this->meses[] = $mes;
	}

	public function getMeses()
	{
		return $this->meses;
	}

	public function geraFaturamentoMesesSeguintes()
	{
		if (count($this->meses) >= 12) {
            $this->meses = array_reverse($this->meses);
			return;
		}

		$soma = 0;

		foreach ($this->meses as $mes) {
			$soma += $mes->getFaturamentoSemFormatacao();
		}

		$media = $soma / count($this->meses);
		$faturamentoMensalPrevisto = $media;

		if ($media < 20000) {
			$faturamentoMensalPrevisto = floatval(20000);
		}

		$mesesFaltantes = 12 - count($this->meses);

		$this->meses = array_reverse($this->meses);

		$ultimoMesFaturamento = $this->meses[0]->getMesSemFormatacao();

		$mesesTemporarios = [];

		for ($i = 0; $i < $mesesFaltantes; $i++) {
			$mes = new Mes();
			$mes->setFaturamento($faturamentoMensalPrevisto);
			$data = \DateTime::createFromFormat('Y-m-d', $ultimoMesFaturamento);
			$periodo = 'P' . ($i + 1) . 'M';
			$data->add(new \DateInterval($periodo));

			$mes->setMes($data->format('Y-m-d'));
			$mesesTemporarios[] = $mes;
		}

		$this->meses = array_reverse($this->meses);
		$arrayFinal = array_merge($this->meses, $mesesTemporarios);
		$this->meses = $arrayFinal;
	}

	public function gerarPdf($empresasId = null)
	{
		$this->geraFaturamentoMesesSeguintes();

		setlocale(LC_ALL, null);
		setlocale(LC_ALL, 'pt_BR');
		$mesPortugues = ucfirst(gmstrftime('%B'));

		$dao = new FaturamentoDAO();
		$infos = $dao->getInfosDeclaracao($empresasId);

		$data = new \DateTime();
		$data->setTimezone(new \DateTimeZone('America/Sao_Paulo'));

		$html = '<html>
				<head>
				</head>
				<body>
				
				<h2 style="text-align:center;">Declaracao de Faturamento</h2>
				
				<p style="padding-top:80px"></p>
				
				<p style="text-align:center;text-align:justify;text-indent:40px;line-height:24px;">
                    <strong>William Andreazi Colombari</strong>, brasileiro, contador, portador do CPF sob nº 043.064.199-08 e CRC-PR 063958/O-0, 
                    com escritório de Contabilidade na Cidade de Maringá - PR., à Av. Pedro Taques, 294, sala 904, <strong>DECLARA</strong> para os 
                    devidos fins de direito e a quem interessar possa, que a <strong>' . $infos->nome_empresa . '</strong>, devidamente inscrita no 
                    CNPJ sob nº ' . Helpers::mask($infos->cnpj, '##.###.###/####-##') . ', estabelecida à ' . $infos->logradouro . ',
                    ' . $infos->numero . ', ' . $infos->bairro . ', ' . $infos->cidade . ' - ' . $infos->uf . ', tem a seguinte <strong>DECLARAÇÃO DE FATURAMENTO.</strong>
				</p>

				<table style="margin:auto;" class="layout">

				<tr><td style="padding-top:25px"></td></tr>

				<tr style="background-color:#E0E0E0"><td>Mês/Ano</td><td style="padding-right:150px"></td><td>Total</td></tr>
				<tr><td style="padding-top:10px"></td></tr>';

		$totalFaturamento = 0;

		foreach ($this->meses as $mes) {
			$html .= '<tr>';
			$html .= '<td>' . $mes->getMes() . '</td><td style="padding-right:150px"></td><td>' . $mes->getFaturamento() . '</td>';
			$html .= '</tr>';
			$totalFaturamento += $mes->getFaturamentoSemFormatacao();
		}

		$html .= '<tr><td style="padding-top:10px"></td></tr>';
		$html .= '<tr style="background-color:#E0E0E0"><td>Total</td><td style="padding-right:150px"></td><td>' . Helpers::formataMoedaView($totalFaturamento) . '</td></tr>';
		$html .= '<tr><td style="padding-top:50px"></td></tr>';
		$html .= '</table>
				<div style="font-size:9pt;margin-bottom:20px;">
				' . $infos->cidade . ', ' . $data->format('d') . ' de ' . $mesPortugues . ' de ' . $data->format('Y') . '.
				</div>
				<div style="text-align:center;">
				<img src="../images/assinatura_william.png" width="242">
				</div>
				</body>
				</html>';

		$mpdf = new \Mpdf\Mpdf(
			[
				'mode' => 'en-GB-x',
				'margin_left' => 10,
				'margin_right' => 10,
				'margin_top' => 10,
				'margin_bottom' => 10,
				'margin_header' => 6,
				'margin_footer' => 3,
			]
		);

		$mpdf->SetDisplayMode('fullpage');
		$mpdf->list_indent_first_level = 0;
		$stylesheet = file_get_contents('../assets/custom-css/faturamento-pdf.css');
		$mpdf->WriteHTML($stylesheet, 1);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
		exit;
	}

	public function verficaMesFaltanteNoMeio()
	{
		$primeiroMes = end($this->meses);
		$mesesTotalExistentes = (count($this->meses) > 12) ? 12 : count($this->meses);
		$mesesASomar = 'P' . $mesesTotalExistentes . 'M';

		$dataInicial = new \DateTimeImmutable($primeiroMes->getMesSemFormatacao());

		$ultimoMesPrevisto = $dataInicial->add(new \DateInterval($mesesASomar));

		$intervalo = new \DateInterval('P1M');

		$daterange = new \DatePeriod($dataInicial, $intervalo, $ultimoMesPrevisto);

		foreach ($daterange as $date) {
			$datasPrevistas[] = $date->format("Y-m-d");
		}

		foreach ($this->meses as $mes) {
			$datasExistentes[] = $mes->getMesSemFormatacao();
		}

		return array_diff($datasPrevistas, $datasExistentes);
	}
}