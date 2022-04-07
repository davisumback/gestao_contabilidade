<?php

namespace App\DAO;
use App\Config\BancoConfig;

class PersonPendenciaDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function setPendencia($personId, $motivoFalha = null, $pendenciaFinalizada = null, $tipoPendencia = null, $erroBanco = null)
    {
        $falha = ($motivoFalha == null) ? 'null' : "'" . $motivoFalha . "'";
        $finalizada = ($pendenciaFinalizada == null) ? 'null' :  $pendenciaFinalizada;
        $tipo = ($tipoPendencia == null) ? 'null' : "'" . $tipoPendencia . "'";

        date_default_timezone_set('America/Sao_Paulo');
        $dataAtual = date('Y-m-d H:i:s');

        if ($this->isPendenciaExistente($personId)) {
            if ($erroBanco != null) {
                $query = "  UPDATE persons_pendencias
                            SET
                                ultima_verificacao = '$dataAtual',
                                motivo_falha = $falha,
                                pendencia_finalizada = $finalizada,
                                tipo_pendencia = $tipo
                            WHERE
                                person_id = $personId;";

                return mysqli_query($this->conexao, $query);
            }

            $query = "  UPDATE persons_pendencias
                        SET
                            numero_email_enviado = numero_email_enviado + 1,
                            ultima_verificacao = '$dataAtual',
                            motivo_falha = $falha,
                            pendencia_finalizada = $finalizada,
                            tipo_pendencia = $tipo
                        WHERE
                            person_id = $personId;";

            return mysqli_query($this->conexao, $query);
        }

        if ($erroBanco != null) {
            $query = "  INSERT INTO persons_pendencias(
                            person_id, ultima_verificacao, motivo_falha, pendencia_finalizada, tipo_pendencia
                        )
                        VALUES(
                            $personId,
                            '$dataAtual',
                            $falha,
                            $finalizada,
                            $tipo
                        );";

            return mysqli_query($this->conexao, $query);
        }

        $query = "  INSERT INTO persons_pendencias(
                        numero_email_enviado, person_id, ultima_verificacao, motivo_falha, pendencia_finalizada, tipo_pendencia
                    )
                    VALUES(
                        1,
                        $personId,
                        '$dataAtual',
                        $falha,
                        $finalizada,
                        $tipo
                    );";

        return mysqli_query($this->conexao, $query);
    }

    // fazer as funções do cron, tanto as que vão fazer verificação de pendências
    // quanto a função que vai sanar a pendência
    public function cron()
    {

    }

    public function isPendenciaExistente($personId)
    {
        $query = "SELECT COUNT(id) as quantidade FROM persons_pendencias WHERE person_id = $personId;";
        $retorno = mysqli_query($this->conexao, $query);
        $resultado = mysqli_fetch_assoc($retorno);

        if ($resultado['quantidade'] > 0) {
            return true;
        }

        return false;
    }
}
