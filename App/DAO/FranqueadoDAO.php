<?php
namespace App\DAO;
use App\Config\BancoConfigPDO;

class FranqueadoDAO
{
    private $conexao;

    public function __construct()
    {        
        $this->conexao = BancoConfigPDO::conecta();
    }

    public function tentaRealizarLoginFranqueado($usuario, $senha, $vinculo)
    {
        $query = "SELECT 
                    u.id, u.usuario, u.nome_completo, u.senha, u.tipo, ativo, u.email, u.avatar, tu.tipo, tu.nome_tipo, tu.pasta
                FROM 
                    franquias_usuarios as fu
                LEFT JOIN
                    franquias as f
                ON
                    fu.franquias_id = f.id
                LEFT JOIN
                    usuarios as u
                ON
                    fu.usuarios_id = u.id
                LEFT JOIN
                    tipo_usuario as tu
                ON
                    u.tipo = tu.id
                WHERE
                    u.usuario = :usuario
                AND
                    u.senha = :senha
                AND
                    tu.id = 10
                AND
                    u.ativo = 1
                AND
                    f.vinculo = :vinculo";
                    
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(':usuario', $usuario, \PDO::PARAM_INT);
        $stmt->bindParam(':senha', $senha, \PDO::PARAM_STR);
        $stmt->bindParam(':vinculo', $vinculo, \PDO::PARAM_STR);

        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);

        $resultado = $stmt->fetch();
        
        if (! $resultado) {
            throw new \Exception("Erro! Franqueado não encontrado.", 1);
        }

        return $resultado;
    }
}