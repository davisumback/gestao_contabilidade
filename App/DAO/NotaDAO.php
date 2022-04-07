<?php

namespace App\DAO;
use App\Entidade\Nota;
use App\Config\BancoConfig;

class NotaDAO
{
    private $conexao;

    function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    function getTodasNotasData($data){
        $notas_array = array();
        $query =    "SELECT
                        n.id, n.titulo, n.texto, n.data_criacao, n.data_retorno, u.usuario
                    FROM
                        notas n
                    LEFT JOIN
                        usuarios u
                    ON
                        n.usuarios_id = u.id
                    WHERE
                        n.data_retorno = '$data'
                    ORDER BY CASE WHEN data_retorno IS NULL THEN 1 ELSE 0 END, data_retorno";
        $retorno = mysqli_query($this->conexao, $query);

        while ($nota = mysqli_fetch_assoc($retorno)) {
            array_push($notas_array, $nota);
        }

        return $notas_array;
    }

    function getTodasNotas(){
        $notas_array = array();
        $query = "  SELECT
                        n.id, n.titulo, n.texto, n.data_criacao, n.data_retorno, u.usuario
                    FROM
                        notas n
                    LEFT JOIN
                        usuarios u
                    ON
                        n.usuarios_id = u.id
                    ORDER BY CASE WHEN data_retorno IS NULL THEN 1 ELSE 0 END, data_retorno
                ;";
        //$query = "SELECT * FROM notas ORDER BY CASE WHEN data_retorno IS NULL THEN 1 ELSE 0 END, data_retorno";
        $retorno = mysqli_query($this->conexao, $query);

        while ($nota = mysqli_fetch_assoc($retorno)) {
            array_push($notas_array, $nota);
        }

        return $notas_array;
    }

    function getNota($id){
        $query = "SELECT * FROM notas WHERE id = $id;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    function getNotasPorData($usuariosId, $data){
        $notas_array = array();
        $query =    "SELECT
                        *
                    FROM
                        notas
                    WHERE
                        data_retorno = '$data'
                    AND
                        usuarios_id = $usuariosId
                    ORDER BY CASE WHEN
                        data_retorno IS NULL THEN 1 ELSE 0 END, data_retorno;";
        $retorno = mysqli_query($this->conexao, $query);

        while ($nota = mysqli_fetch_assoc($retorno)) {
            array_push($notas_array, $nota);
        }

        return $notas_array;
    }

    function alteraNota(Nota $nota){
        if($nota->getDataRetorno() == null){
            $query = "  UPDATE notas
                        SET
                            titulo = '{$nota->getTitulo()}',
                            texto = '{$nota->getTexto()}',
                            data_retorno = null
                        WHERE
                            id = {$nota->getId()}
                    ";
        }else {
            $query = "  UPDATE notas
                        SET
                            titulo = '{$nota->getTitulo()}',
                            texto = '{$nota->getTexto()}',
                            data_retorno = '{$nota->getDataRetorno()}'
                        WHERE
                            id = {$nota->getId()}
                    ";
        }


        return mysqli_query($this->conexao, $query);
    }

    function alteraNotaEmpresa(Nota $nota){
        if($nota->getDataRetorno() == null){
            $query = "  UPDATE notas
                        SET
                            titulo = '{$nota->getTitulo()}',
                            texto = '{$nota->getTexto()}',
                            data_retorno = null
                        WHERE
                            id = {$nota->getId()}
                    ";
        }else {
            $query = "  UPDATE notas
                        SET
                            titulo = '{$nota->getTitulo()}',
                            texto = '{$nota->getTexto()}',
                            data_retorno = '{$nota->getDataRetorno()}'
                        WHERE
                            id = {$nota->getId()}
                    ";
        }


        return mysqli_query($this->conexao, $query);
    }

    function deletaNota($nota_id){
        $query = "DELETE FROM notas WHERE id = $nota_id;";
        return mysqli_query($this->conexao, $query);
    }

    function insereNota(Nota $nota, $usuario_id){
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d');

        if($nota->getDataRetorno() == null){
            $query = "  INSERT INTO notas (
                            titulo, texto, data_criacao, usuarios_id, data_retorno
                        )
                        VALUES (
                            '{$nota->getTitulo()}',
                            '{$nota->getTexto()}',
                            '{$data}',
                            $usuario_id,
                            null
                        );";
        }else {
            $query = "  INSERT INTO notas (
                            titulo, texto, data_criacao, usuarios_id, data_retorno
                        )
                        VALUES (
                            '{$nota->getTitulo()}',
                            '{$nota->getTexto()}',
                            '{$data}',
                            $usuario_id,
                            '{$nota->getDataRetorno()}'
                        );";
        }

        return mysqli_query($this->conexao, $query);
    }

    function insereNotaEmpresa(Nota $nota, $usuario_id, $empresaId){
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d');

        if($nota->getDataRetorno() == null){
            $query = "  INSERT INTO notas (
                            titulo, texto, data_criacao, usuarios_id, data_retorno, empresas_id
                        )
                        VALUES (
                            '{$nota->getTitulo()}',
                            '{$nota->getTexto()}',
                            '{$data}',
                            $usuario_id,
                            null,
                            NULLIF($empresaId, '')
                        );";
        }else {
            $query = "  INSERT INTO notas (
                            titulo, texto, data_criacao, usuarios_id, data_retorno, empresas_id
                        )
                        VALUES (
                            '{$nota->getTitulo()}',
                            '{$nota->getTexto()}',
                            '{$data}',
                            $usuario_id,
                            '{$nota->getDataRetorno()}',
                            NULLIF($empresaId, '')
                        );";
        }

        return mysqli_query($this->conexao, $query);
    }

    public function getNotas($usuario_id)
    {
        $notas_array = array();
        $query = "SELECT * FROM notas WHERE usuarios_id = $usuario_id ORDER BY CASE WHEN data_retorno IS NULL THEN 1 ELSE 0 END, data_retorno";
        $retorno = mysqli_query($this->conexao, $query);

        while ($nota = mysqli_fetch_assoc($retorno)) {
            array_push($notas_array, $nota);
        }

        return $notas_array;
    }

    public function getNotasEmpresa($usuario_id, $empresas_id)
    {
        $notas_array = array();
        $query = "SELECT * FROM notas WHERE usuarios_id = $usuario_id AND empresas_id = $empresas_id ORDER BY CASE WHEN data_retorno IS NULL THEN 1 ELSE 0 END, data_retorno";
        $retorno = mysqli_query($this->conexao, $query);

        while ($nota = mysqli_fetch_assoc($retorno)) {
            array_push($notas_array, $nota);
        }

        return $notas_array;
    }

    public function quantidadeNotas($usuariosId) 
    {
        $query = "SELECT count(id) as quantidade FROM notas WHERE usuarios_id = $usuariosId ORDER BY CASE WHEN data_retorno IS NULL THEN 1 ELSE 0 END, data_retorno";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }
}
