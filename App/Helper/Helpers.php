<?php

namespace App\Helper;

class Helpers {

    public static function mask($val, $mask)
    {
        if ($val == '') {
            return '';
        }
        
    	$maskared = '';
    	$k = 0;

    	for($i = 0; $i<=strlen($mask)-1; $i++){
    		if($mask[$i] == '#'){
    			if(isset($val[$k])){
    				$maskared .= $val[$k++];
    			}
    		}else{
    			if(isset($mask[$i])){
    				$maskared .= $mask[$i];
    			}
    		}
    	}

    	return $maskared;
    }

    public function retiraAcentos($entrada)
    {
        return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$entrada);
    }

    public function retiraCaracteresEspeciais($entrada)
    {
        return preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($entrada)));
    }

    public static function isUrl($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        return ($code == 200); 
    }

    public static function redirect($caminho)
    {
        echo "<meta http-equiv=refresh content='26;URL=$caminho' />";
        // echo "<script>location.href='$caminho';</script>";
        die();
    }

    public static function formataDataPeriodo($operacao, $data, $periodo, $formato)
    {
        $date = new \DateTime($data); // data
        $date->$operacao(new \DateInterval($periodo)); // 'P10D'

        return $date->format($formato);// 'Y-m-d'
    }

    public static function formataDataPeriod($operacao, $data, $periodo, $formato)
    {
        $date = \DateTime::createFromFormat('d/m/Y', $data);
        $date->$operacao(new \DateInterval($periodo)); // 'P10D'

        return $date->format($formato);
    }

    public static function modificaDataPeriodo($data, $periodo, $formato)
    {
        $date = \DateTime::createFromFormat('Y-m-d', $data);
        
        return $date->modify($periodo)->format($formato); // '+1 day'
    }

    public static function calculaDiferencaDatas($dataInicial, $dataFinal, $tipoData)
    {
        $dataInicial = new \DateTime($dataInicial);
        $dataFinal = new \DateTime($dataFinal);
        $intervalo = $dataInicial->diff($dataFinal);

        return $intervalo->$tipoData;
    }

    public static function formataDataVencimentoView($diaVencimento, $dataCompetencia)
    {
        $vencimento = $diaVencimento . '/' . $dataCompetencia;
        
        $vencimento = str_replace('/', '-', $vencimento);
        $date = new \DateTime($vencimento);

        $competencia = \explode('/', $dataCompetencia);

        if ($competencia[0] == '02') {
            $date->add(new \DateInterval('P28D'));
        } else {
            $date->add(new \DateInterval('P1M'));
        }

        return $date->format('d/m/Y');
    }

    public static function isEmpresaDeOutroEscritorio($nome1, $nome2, $nome3)
    {
        return ($nome1 == $nome2 && $nome1 == $nome3);
    }

    public static function formataNomeGuiaEmail($nomeGuia)
    {
        $nomeGuiaFormatado = substr($nomeGuia, strpos($nomeGuia,'-') + 1);
        $nomeGuiaFormatado = str_replace('.pdf','',$nomeGuiaFormatado);

        return $nomeGuiaFormatado = str_replace('-',' e ',$nomeGuiaFormatado);
    }

    function formataObservacaoMesmoAnexo($nomeGuiaFormatado)
    {
        if (strpos($nomeGuiaFormatado, 'e') != false) {
            return '(As duas guias estão no mesmo anexo).';
        }

        return '';
    }

    public static function formataNomeGuia($nomeOriginalGuia, $empresasId, $tipoGuia)
    {
        $ext = strtolower(substr($nomeOriginalGuia,-4));
        $nomeGuia = $empresasId . '-' . $tipoGuia . $ext;

        return $nomeGuia;
    }

    public static function formataCpfBd($cpfEntrada)
    {
    	$cpf = str_replace("-","",$cpfEntrada);
    	$cpf = str_replace(".","",$cpf);

    	return $cpf;
    }

    public static function formataMoedaView($moeda_entrada)
    {
    	return number_format($moeda_entrada, 2, ',', '.');
    }

    public static function formataDataBd($data)
    {
        if ($data == null) return '';
        
        $data = str_replace('/' , '-', $data);
        return date('Y-m-d', strtotime($data));
    }

    public static function formataDataView($data)
    {
        if ($data == '') return '';
    	$data_saida = str_replace('-', '', $data);

    	return date('d/m/Y', strtotime($data_saida));
    }

    public static function formataDataCompetenciaView($data)
    {
        if ($data == '') return '';

        $date = new \DateTime($data);

        return $date->format('m/Y');
    }

    public static function formataDataCompetenciaUrl($data)
    {
        if ($data == '') return '';

        $date = new \DateTime($data);

        return $date->format('m-Y');
    }

    public static function formataDataCompletaView($data)
    {
    	$data_saida = str_replace('-', '', $data);

    	return date('d/m/Y H:i:s', strtotime($data_saida));
    }

    public function formataDataCompetencia($data)
    {
        $date = date_create($data);

        return date_format($date,"m/Y");
    }

    public function formataDataPasta($data)
    {
        $date = date_create($data);

        return date_format($date,"m-Y");
    }

    public static function formataPisBd($pis_entrada)
    {
    	$pis = str_replace('-', '', $pis_entrada);
    	$pis = str_replace('.', '', $pis);

    	return $pis;
    }

    public static function formataMoedaBd($get_valor)
    {
    	$source = array('.', ',');
    	$replace = array('', '.');
    	$valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto

    	return $valor; //retorna o valor formatado para gravar no banco
    }

    public static function formataStringMoeda($get_valor)
    {
    	$source = array('.', ',');
    	$replace = array('', '.');
    	$valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto

    	return $valor; //retorna o valor formatado para gravar no banco
    }

    public static function formataCnpjBd($cnpjEntrada)
    {
        if ($cnpjEntrada == '') {
            return '';
        }

    	$cnpj = str_replace("-","",$cnpjEntrada);
    	$cnpj = str_replace("/","",$cnpj);
    	$cnpj = str_replace(".","",$cnpj);

    	return $cnpj;
    }

    public static function formataCepBd($cepEntrada)
    {
    	$cep = str_replace("-","",$cepEntrada);

    	return $cep;
    }

    public static function formataTelefoneBd($telefone)
    {
    	$telefone_celular = str_replace("(","",$telefone);
    	$telefone_celular = str_replace(")","",$telefone_celular);
    	$telefone_celular = str_replace("-","",$telefone_celular);
    	$telefone_celular = str_replace(" ","",$telefone_celular);

    	return $telefone_celular;
    }

    public static function formataNomeArquivoExistente($nomeArquivo)
    {
        $contador = 0;

        // echo $arquivoSemExtensao . '<br>';

        echo $nomeArquivo . '<br>';

        if (\file_exists($nomeArquivo)) {
            $extensaoArquivo = pathinfo($nomeArquivo, PATHINFO_EXTENSION);
            $arquivoSemExtensao = str_replace('.'.$extensaoArquivo, '', $nomeArquivo);
            $arquivoSemExtensao .= '[__' .++$contador. '__]';
            $arquivoComExtensao = $arquivoSemExtensao . '.' . $extensaoArquivo;
            
          

            self::formataNomeArquivoExistente($arquivoComExtensao);
        }

        return $nomeArquivo;
    }

    public static function formataCnaeBd($valorCnae)
    {
    	$cnae = str_replace("-","",$valorCnae);
    	$cnae = str_replace("/","",$cnae);

    	return $cnae;
    }
}