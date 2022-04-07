<?php

namespace App\DAO;
use App\Entidade\ClienteEmail;

class ClienteEmailDAO{
    private $conexao;

    function __construct($conexao){
        $this->conexao = $conexao;
    }

    function getNumeroEmailPropostasComerciais($usuarios_id, $clientes_id){
        $query = "  SELECT
                        u.id, u.usuario, ce.id, ce.clientes_id, ce.usuarios_id, ce.enviado, ce.tipos_email_id
                    FROM
                        usuarios as u
                    LEFT JOIN
                        cliente_email as ce
                    ON
                        u.id = ce.usuarios_id
                    WHERE
                        clientes_id = $clientes_id
                    AND
                        ce.usuarios_id = $usuarios_id
                    AND
                        enviado = 1
                    AND
                        tipos_email_id = 1
        ;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_num_rows($retorno);
    }


    function insereEmailEnviado(ClienteEmail $cliente_email){
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d H:i:s');
        $query = "  INSERT INTO cliente_email (
                        clientes_id, usuarios_id, data_hora, enviado, tipos_email_id
                    )
                    VALUES (
                        '{$cliente_email->getClientesId()}',
                        '{$cliente_email->getUsuariosId()}',
                        '{$data}',
                        {$cliente_email->getEnviado()},
                        {$cliente_email->getTiposEmailId()}
                    );";

        return mysqli_query($this->conexao, $query);
    }


}
