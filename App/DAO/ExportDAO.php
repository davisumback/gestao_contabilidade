<?php

namespace App\DAO;
use App\Config\BancoConfig;

class ExportDAO{
    function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function insereCliente($cliente)
    {
        $iesId = ($cliente['ies_id'] == 0) ? 'null' : $cliente['id'];

        $query = "INSERT INTO clientes(
            id,
            nome_completo, cpf, situacao_cadastral, email, data_nascimento, crm, telefone_comercial, telefone_celular,
            cadastro_completo, sexo, estado_civil, regime_casamento, profissao, ies_id, ativo, nome_mae, socio_administrador
            ) VALUES (
                {$cliente['id']}, '{$cliente['nome_completo']}', '{$cliente['cpf']}', '{$cliente['situacao_cadastral']}', '{$cliente['email']}',
                '{$cliente['data_nascimento']}', '{$cliente['crm']}', '{$cliente['telefone_comercial']}', '{$cliente['telefone_celular']}',
                {$cliente['cadastro_completo']}, '{$cliente['sexo']}', '{$cliente['estado_civil']}', '{$cliente['regime_casamento']}',
                '{$cliente['profissao']}', $iesId, {$cliente['ativo']},
                '{$cliente['nome_mae']}', {$cliente['socio_administrador']}
            )";
            
        return \mysqli_query($this->conexao, $query);
    }

    public function insereEmpresa($empresa)
    {
        $dataViabilidade = ($empresa['data_viabilidade'] == '') ? 'null' : '\'' . $empresa['data_viabilidade'] . '\'';
        $dataSn = ($empresa['data_sn'] == '') ? 'null' : '\'' . $empresa['data_sn'] . '\'';
        $irpj = ($empresa['pagamento_irpj_csll'] == '') ? 'null' : '\'' . $empresa['pagamento_irpj_csll'] . '\'';

        $query = "INSERT INTO empresas (
            id, tipo_societario, nome_empresa, regime_tributario, cnpj, data_viabilidade, objeto, capital_social, pagamento_irpj_csll, saiu, congelada, 
            atividade_principal, inicio_atividades, data_sn, porte, vinculo
            ) VALUES (
                {$empresa['id']}, '{$empresa['tipo_societario']}', '{$empresa['nome_empresa']}', '{$empresa['regime_tributario']}', '{$empresa['cnpj']}',
                $dataViabilidade, '{$empresa['objeto']}', '{$empresa['capital_social']}', $irpj, {$empresa['saiu']}, 
                {$empresa['congelada']}, '{$empresa['atividade_principal']}', '{$empresa['inicio_atividades']}', $dataSn, '{$empresa['porte']}', 
                '{$empresa['vinculo']}'
            );";
            // echo $query . '<br>'; 
    
        return \mysqli_query($this->conexao, $query);
    }

    public function insereFranquiasUsuarios($empresa)
    {
        $query = "INSERT INTO franquias_usuarios (
                    franquias_id, usuarios_id, created_at
                ) VALUES (
                    {$empresa['franquias_id']}, {$empresa['usuarios_id']}, '{$empresa['created_at']}'
                );";
        echo $query . '<br>';

        // return \mysqli_query($this->conexao, $query);
    }

    public function insereTiposOs($empresa)
    {
        $metodoGet = ($empresa['metodo_get'] == null) ? 'null' : '\'' . $empresa['metodo_get'] . '\'';

        $query = "INSERT INTO tipos_os (
                    nome_tipo, tipo, dias_minimo, fator_x, titulo, metodo_get
                ) VALUES (
                    '{$empresa['nome_tipo']}', '{$empresa['tipo']}', {$empresa['dias_minimo']}, {$empresa['fator_x']}, '{$empresa['titulo']}', $metodoGet
                );";
        echo $query . '<br>';

        // return \mysqli_query($this->conexao, $query);
    }

    public function insereContrato($empresa)
    {
        $query = "INSERT INTO contratos (
                    dia_vencimento, empresas_id
                ) VALUES (
                    '{$empresa['dia_vencimento']}', {$empresa['empresas_id']}
                );";

        return \mysqli_query($this->conexao, $query);
    }

    public function insereClienteEmpresa($empresa)
    {
        $query = "INSERT INTO clientes_empresas (
                    clientes_id, empresas_id, porcentagem_societaria, socio_administrador
                ) VALUES (
                    {$empresa['clientes_id']}, {$empresa['empresas_id']}, {$empresa['porcentagem_societaria']}, '{$empresa['socio_administrador']}'
                );";

        return \mysqli_query($this->conexao, $query);
    }

    public function insereEmpresaLiberacao($empresa)
    {
        $updatedAt = ($empresa['updated_at'] == '') ? 'null' : '\'' . $empresa['updated_at'] . '\'';

        $query = "INSERT INTO empresas_liberacoes (
                    id, empresas_id, data_competencia, created_at, updated_at
                ) VALUES (
                    {$empresa['id']}, {$empresa['empresas_id']}, '{$empresa['data_competencia']}', '{$empresa['created_at']}', $updatedAt
                );";

        return \mysqli_query($this->conexao, $query);
    }

    public function insereEmpresaProlabore($empresa)
    {
        $updatedAt = ($empresa['updated_at'] == '') ? 'null' : '\'' . $empresa['updated_at'] . '\'';

        $query = "INSERT INTO empresas_prolabores (
            id, empresas_id, prolabore, data_competencia, created_at, updated_at
        ) VALUES (
            {$empresa['id']}, {$empresa['empresas_id']}, '{$empresa['prolabore']}', '{$empresa['data_competencia']}', '{$empresa['created_at']}', $updatedAt
        );";

       return \mysqli_query($this->conexao, $query);
    }

    public function inserePlano($plano)
    {
        $pipedrive = ($plano['nome_pipedrive'] == '') ? 'null' : '\'' . $plano['nome_pipedrive'] . '\'';

        $query = "INSERT INTO planos (
            id, nome, valor, nome_pipedrive
        ) VALUES (
            {$plano['id']}, '{$plano['nome']}', {$plano['valor']}, $pipedrive
        );";

        return \mysqli_query($this->conexao, $query);
    }

    public function getEmpresasRegimeTributario()
    {
        $query = "SELECT id, regime_tributario FROM empresas;";
        $retorno = \mysqli_query($this->conexao, $query);
        $empresas = array();

        while ($empresa = \mysqli_fetch_assoc($retorno)) {
            $empresas [] = $empresa;
        }

        return $empresas;
    }

    public function insereRegimeTributarioCompetencia($empresa)
    {
        $query = "INSERT INTO empresas_regime_tributario (
            empresas_id, regime_tributario, data_competencia, created_at
        ) VALUES (
            {$empresa['empresas_id']}, '{$empresa['regime_tributario']}', '{$empresa['data_competencia']}', '{$empresa['created_at']}'
        );";

        return \mysqli_query($this->conexao, $query);
    }
}