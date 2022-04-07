<?php
namespace App\Model\Marketing;

use App\Config\BancoConfigPDO;

class Marketing
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfigPDO::conecta();
    }

    public function allRespostas()
    {
        $query = "SELECT
                    pp.nome_completo, pp.cidade_origem, pp.ano_formacao, pp.telefone, pp.email, 
                    p.nome_palestra, p.cidade, p.data_palestra, p.estado
                FROM
                    participantes_palestras as pp
                LEFT JOIN
                    palestras as p
                ON
                    pp.palestras_id = p.id_palestra;";

        $sth = $this->conexao->prepare($query);
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }
}
