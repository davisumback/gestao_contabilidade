<?php

namespace App\DAO;
use APP\Usuario\Usuario;
use App\Config\BancoConfig;

class UsuarioDAO{
    private $conexao;

    function __construct(){
        $this->conexao = BancoConfig::conecta();
    }

    function getPerfilUsuario($tipo){
        $query = "  SELECT
                        u.id, g.nome_gestor
                    FROM
                        usuarios AS u
                    INNER JOIN
                        tipo_usuario as tu
                    ON
                        tu.tipo = u.tipo
                    LEFT JOIN
                        gestores as g
                    ON
                        g.id_usuarios = u.id
                    WHERE
                        tu.tipo = $tipo
                    AND
                        g.nome_gestor IS NOT NULL
                    ;";
        $retorno = mysqli_query($this->conexao, $query);
        $usuarios = array();
        while($usuario = mysqli_fetch_assoc($retorno)){
            $usuarios[] = $usuario;
        }

        return $usuarios;
    }

    function alteraUsuario(Usuario $usuario){
        if($usuario->getAvatar() == ""){
            $avatar = null;
        }else{
            $avatar = "avatar = '{$usuario->getAvatar()}',";
        }

        $query = "  UPDATE
                        usuarios
                    SET
                        usuario = '{$usuario->getUsuario()}',
                        senha = '{$usuario->getSenha()}',
                        nome_completo = '{$usuario->getNomeCompleto()}',
                        $avatar
                        email = '{$usuario->getEmail()}',
                        tipo = '{$usuario->getTipo()}'
                    WHERE
                        id = '{$usuario->getId()}'
                ;";

        return mysqli_query($this->conexao, $query);
    }

    public function ativaDesativaUsuario($id, $acao)
    {
        $query = "UPDATE usuarios SET ativo = $acao WHERE id = $id";

        return mysqli_query($this->conexao, $query);
    }

    public function getDadosUsuarioEmailMecontabil($id)
    {
        $query = "SELECT 
                    u.email_integracao, u.telefone_celular, u.senha_email, u.avatar, u.nome_completo, u.usuario, fu.usuarios_id,
                    fe.logradouro, fe.numero, fe.bairro, fe.cidade, fe.uf, fe.complemento
                FROM
                    usuarios as u
                LEFT JOIN
                    franquias_usuarios as fu
                ON
                    u.id = fu.usuarios_id
                LEFT JOIN
                    franquias_enderecos as fe
                ON
                    fu.franquias_id = fe.franquias_id
                WHERE
                    u.id = $id;";
                    
        $retorno = \mysqli_query($this->conexao, $query);
        
        return \mysqli_fetch_assoc($retorno);
    }

    public function getUsuario($id)
    {
        $query = "SELECT * FROM usuarios WHERE id = $id;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    function isUsuarioCadastrado($usuario){
        $query = "SELECT * FROM usuarios WHERE usuario = '{$usuario}';";

        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    function insereUsuario(Usuario $usuario){
        $query = "  INSERT INTO usuarios (
                        usuario, nome_completo, senha, tipo, data_criacao, ativo, email, avatar
                    )
                    VALUES (
                        '{$usuario->getUsuario()}',
                        '{$usuario->getNomeCompleto()}',
                        '{$usuario->getSenha()}',
                        '{$usuario->getTipo()}',
                        '{$usuario->getDataCriacao()}',
                        1,
                        '{$usuario->getEmail()}',
                        '{$usuario->getAvatar()}'
                    )
                ;";

        return mysqli_query($this->conexao, $query);
    }

    function getTodosUsuarios(){
        $usuarios = array();
        $query = "  SELECT
                        u.id, u.usuario, u.email, u.avatar, u.ativo, t.nome_tipo
                    FROM
                        usuarios u
                    LEFT JOIN
                        tipo_usuario t
                    ON
                        u.tipo = t.tipo
                    WHERE
                        u.tipo <> '{}' ;";
        $resultado = mysqli_query($this->conexao, $query);

        while($usuario = mysqli_fetch_assoc($resultado)){
            array_push($usuarios, $usuario);
        }

        return $usuarios;
    }

    function alteraSenha($id_usuario, $senha){
        $query = "UPDATE usuarios SET senha = '{$senha}' WHERE id = $id_usuario";

        return mysqli_query($this->conexao, $query);
    }

    function verificaUsuarioESenha($usuario, $senha){
        $user = mysqli_real_escape_string($this->conexao, $usuario);
        $password = mysqli_real_escape_string($this->conexao, $senha);

        $query = "  SELECT
                        u.id, usuario, nome_completo, senha, u.tipo, ativo, email, avatar, t.tipo, t.nome_tipo, t.pasta
                    FROM
                        usuarios as u
                    LEFT JOIN
                        tipo_usuario as t
                        ON u.tipo = t.tipo
                    WHERE
                        u.usuario = '{$user}'
                        AND
                        u.senha = '{$password}'
                    ;";

        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }
}
