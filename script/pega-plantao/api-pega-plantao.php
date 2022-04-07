<?php

require_once '../../vendor/autoload.php';
require_once 'config-pega-plantao.php';
require_once 'api-pega-plantao-error.php';

use App\Model\PegaPlantao\PegaPlantao;
use App\DAO\PegaPlantaoDAO;
use App\DAO\PegaPlantaoParceiroDAO;

$data['StartDate'] = $_GET['start_date'] ?? START_DATE;
$data['EndDate'] = $_GET['end_date'] ?? END_DATE;
$parceiro = $_GET['parceiro'] ?? null;
$mensagem = "sucesso";

$parceiros = array();
if($parceiro){
  $parceiros[] = PegaPlantaoParceiroDAO::find($parceiro);
}else{
  $parceiros = PegaPlantaoParceiroDAO::all();
}

//busca os dados conforme os parceiros
foreach ($parceiros as $parceiro) {
	
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => $parceiro->getUrl(),
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT => 60,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => json_encode($data),
		CURLOPT_HTTPHEADER => array(
			"Authorization: Basic ".$parceiro->getToken(),
			"content-type: application/json"
		)
	));

	$resposta = curl_exec($curl);
	$erro = curl_error($curl);
	$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	curl_close($curl);
	
	if($erro){
		gerarLog($parceiro, "$httpcode | ".$erro.", Período ".$data['StartDate']." até ".$data['EndDate']);
		$mensagem = $erro;
	}else{
		$verificaResposta = json_decode($resposta);
		
		if(!empty($verificaResposta->Message)){
			gerarLog($parceiro, "$httpcode | ".$verificaResposta->Message.", Período ".$data['StartDate']." até ".$data['EndDate']);
			$mensagem = $verificaResposta->Message;
			continue;
		}elseif($resposta == 'Período máximo deve ser de 6 meses'){
			gerarLog($parceiro, "$httpcode | Período máximo deve ser de 6 meses, Período ".$data['StartDate']." até ".$data['EndDate']);
			$mensagem = $verificaResposta->Message;
			continue;
		}
		
		$csv = explode(PHP_EOL, $resposta);
		unset($csv[0]);
		foreach ($csv as $linha) {
			$dados = str_getcsv($linha,";");

			$profissionalDePlantao = addslashes($dados[11]);
			$inicio = date("Y-m-d H:i:s",strtotime(str_replace("/","-",$dados[4])));
			$fim = date("Y-m-d H:i:s",strtotime(str_replace("/","-",$dados[5])));
			$valor = $dados[7];
			$descricao = addslashes($dados[13]);
			$codigoProfissionalFixo = preg_replace("/[^0-9]/", "", $dados[9]);
			$codigoProfissionalDePlantao = preg_replace("/[^0-9]/", "",$dados[12]);


			$pegaPlantao = new PegaPlantao;
			$pegaPlantao->setProfissionalDePlantao($profissionalDePlantao)
						->setInicio($inicio)
						->setFim($fim)
						->setValor($valor)
						->setDescricao($descricao)
						->setCodigoProfissionalFixo($codigoProfissionalFixo)
						->setCodigoProfissionalDePlantao($codigoProfissionalDePlantao)
						->setParceiro($parceiro);

			PegaPlantaoDAO::create($pegaPlantao);
		}
	}
}
echo $mensagem;


/*
[0] => Local
[1] => CodigoLocal
[2] => Setor
[3] => CodigoSetor
[4] => Inicio
[5] => Fim
[6] => Tipo
[7] => Valor
[8] => ProfFixo
[9] => CodigoProfFixo
[10] => ProfFixoStatus
[11] => ProfDePlantao
[12] => CodigoProfDePlantao
[13] => Descricao
[14] => ComentarioInterno
[15] => atendimentos

Inicio -> Hora e data de início do plantão
Fim -> Hora e data do fim do plantão
Valor -> Valor do plantão (pode ser vazio)
Descricao -> Descrição do plantão (pode ser vazio)
CodigoProfFixo -> Código do profissional fixo (pode ser vazio)
CodigoProfDePlantao -> Código do profissional de plantão (pode ser vazio)
ProfDePlantao -> Nome do profissional que fez/fara o plantão (pode ser vazio)

*/