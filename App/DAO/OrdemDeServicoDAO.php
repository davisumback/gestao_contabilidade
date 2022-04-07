<?php

namespace App\DAO;
use App\Config\BancoConfig;

class OrdemDeServicoDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function getUsuariosContrato()
    {
        $query = "SELECT id FROM usuarios WHERE tipo = 3 AND ativo = 1;";
        $retorno = \mysqli_query($this->conexao, $query);
        $usuarios = \mysqli_fetch_assoc($retorno);

        if ($usuarios == null) {
            throw new \Exception("Nenhum usuário de contratos foi encontrado.", 1);
        }

        return $usuarios;
    }

    public function insereOrdemDeServicoSetor($titulo, $tipoOs, $grupoBSetoresId)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query =    "INSERT INTO ordens_de_servicos (
                        titulo, created_at, status, tipos_os_id, grupob_setores_id
                    ) VALUES (
                        '$titulo', '$now', 'PENDENTE', $tipoOs, $grupoBSetoresId
                    );";
        
        $dados['resultado'] = \mysqli_query($this->conexao, $query);

        if ($dados['resultado'] == false) {
            throw new \Exception("Erro ao salvar Ordem de Serviço no banco!", 1);
        }

        $dados['ordensDeServicosId'] = \mysqli_insert_id($this->conexao);
        
        return $dados;
    }

    public function insereOrdemDeServico($titulo, $tipoOs)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query =    "INSERT INTO ordens_de_servicos (
                        titulo, created_at, status, tipos_os_id
                    ) VALUES (
                        '$titulo', '$now', 'PENDENTE', $tipoOs
                    );";
        
        $dados['resultado'] = \mysqli_query($this->conexao, $query);

        if ($dados['resultado'] == false) {
            throw new \Exception("Erro ao salvar Ordem de Serviço no banco!", 1);
        }

        $dados['ordensDeServicosId'] = \mysqli_insert_id($this->conexao);
        
        return $dados;
    }

    public function insertItensOsDescricao($ordemDeServicoId, $itemId, $descricao)
    {
        $query = "INSERT INTO ordens_de_servicos_itens (ordens_de_servicos_id, item_id, descricao) VALUES ($ordemDeServicoId, $itemId, '$descricao');";

        if (\mysqli_query($this->conexao, $query) == false) {
            throw new \Exception("Erro ao salvar Itens da Ordem de Serviço no banco!", 1);
        }
    }

    public function insertItensOs($ordemDeServicoId, $itemId)
    {
        $query = "INSERT INTO ordens_de_servicos_itens (ordens_de_servicos_id, item_id) VALUES ($ordemDeServicoId, $itemId);";

        if (\mysqli_query($this->conexao, $query) == false) {
            throw new \Exception("Erro ao salvar Itens da Ordem de Serviço no banco!", 1);
        }
    }

    public function insertItensOsDeclaracaoRendimentos($ordemDeServicoId, $itemId, $clientesId)
    {
        $query = "INSERT INTO ordens_de_servicos_itens (ordens_de_servicos_id, item_id, clientes_id) VALUES ($ordemDeServicoId, $itemId, $clientesId);";

        if (\mysqli_query($this->conexao, $query) == false) {
            throw new \Exception("Erro ao salvar Itens da Ordem de Serviço no banco!", 1);
        }
    }

    public function insereUsuarioMedcontabilOsEmissao($ordensDeServicoId, $usuariosId, $empresasId)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO os_empresas_emissoes (
            ordens_de_servicos_id, clientes_id, created_at
        ) VALUES (
            $ordensDeServicoId, $usuariosId, '$now'
        );";

        if (\mysqli_query($this->conexao, $query) == false) {
            throw new \Exception("Erro ao salvar o usuário que emitiu a OS!", 1);
        }
    }

    public function insereUsuarioOsEmissao($ordensDeServicoId, $usuariosId, $empresasId)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO os_usuarios_emissoes (
            ordens_de_servicos_id, usuarios_id, empresas_id, created_at
        ) VALUES (
            $ordensDeServicoId, $usuariosId, $empresasId, '$now'
        );";

        if (\mysqli_query($this->conexao, $query) == false) {
            throw new \Exception("Erro ao salvar o usuário que emitiu a OS!", 1);
        }
    }

    public function insereUsuarioOsEmissaoMedcontabil($ordensDeServicoId, $usuariosId, $empresasId)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO os_empresas_emissoes (
            ordens_de_servicos_id, clientes_id, created_at
        ) VALUES (
            $ordensDeServicoId, $usuariosId, '$now'
        );";

        if (\mysqli_query($this->conexao, $query) == false) {
            throw new \Exception("Erro ao salvar o usuário que emitiu a OS!", 1);
        }
    }

    public function insereUsuarioOsEmissaoSemEmpresa($ordensDeServicoId, $usuariosId)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO os_usuarios_emissoes (
            ordens_de_servicos_id, usuarios_id, created_at
        ) VALUES (
            $ordensDeServicoId, $usuariosId, '$now'
        );";

        if (\mysqli_query($this->conexao, $query) == false) {
            throw new \Exception("Erro ao salvar o usuário que emitiu a OS!", 1);
        }
    }

    public function insereUsuarioOsRecebeSemEmpresa($ordensDeServicoId, $usuariosId)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO os_usuarios_recebimentos (
            ordens_de_servicos_id, usuarios_id, created_at
        ) VALUES (
            $ordensDeServicoId, $usuariosId, '$now'
        );";

        if (\mysqli_query($this->conexao, $query) == false) {
            throw new \Exception("Erro ao salvar o usuário que vai receber a OS!", 1);
        }
    }

    public function insereUsuarioOsRecebe($ordensDeServicoId, $empresasId, $usuariosId)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO os_usuarios_recebimentos (
            ordens_de_servicos_id, empresas_id, usuarios_id, created_at
        ) VALUES (
            $ordensDeServicoId, $empresasId, $usuariosId, '$now'
        );";

        if (\mysqli_query($this->conexao, $query) == false) {
            throw new \Exception("Erro ao salvar o usuário que vai receber a OS!", 1);
        }
    }

    public function getContadorEmpresa($empresasId)
    {
        $query = "SELECT usuarios_id as contadorId FROM contadores_empresas WHERE empresas_id = $empresasId;";
        $retorno = \mysqli_query($this->conexao, $query);

        if ($retorno == null) {
            throw new \Exception("Falha ao buscar o contador da empresa!", 1);
        }

        return \mysqli_fetch_assoc($retorno);
    }

    public function getGestorEmpresa($empresasId)
    {
        $query = "SELECT usuarios_id as gestorId FROM gestores_empresas WHERE empresas_id = $empresasId;";
        $retorno = \mysqli_query($this->conexao, $query);

        if ($retorno == null) {
            throw new \Exception("Falha ao buscar o gestor da empresa!", 1);
        }

        return \mysqli_fetch_assoc($retorno);
    }
}