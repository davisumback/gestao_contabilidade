<?php
namespace App\Arquivo;

class UploadArquivo
{
    private static $resultado;

    public function uploadArchive($arquivoTemporario, $nomeArquivo, $caminho)
    {
        $extensoesPermitidas = array(".pdf", ".jpeg", ".jpg", ".txt", ".pfx", ".doc", ".docx");

        $ext = strtolower(substr($nomeArquivo,-4));

        if (in_array($ext, $extensoesPermitidas)) {
            // $new_name = date("Y.m.d-H.i.s") . $ext;

            return move_uploaded_file($arquivoTemporario, $caminho.'/'.$nomeArquivo); 
        }

        return false;
    }

    public function enviaArquivoNomeFormatado($fileArray, $caminho, $nome)
    {
        if ($fileArray['error'] == 0) {

            $name     = $fileArray['name']; //Atribui uma array com os nomes dos arquivos à variável
            $tmp_name = $fileArray['tmp_name']; //Atribui uma array com os nomes temporários dos arquivos à variável

            $allowedExts = array("pdf", "jpeg", "jpg"); //Extensões permitidas

            $dir = $caminho;
            $ext = pathinfo($name, PATHINFO_EXTENSION);

            if (in_array($ext, $allowedExts)) { //Pergunta se a extensão do arquivo, está presente no array das extensões permitidas
                // $new_name = date("Y.m.d-H.i.s") . '.' . $ext;

                self::$resultado = move_uploaded_file($fileArray['tmp_name'], $dir . '/' . $nome); //Fazer upload do arquivo
            }
        }

        return self::$resultado;
    }

    public function enviaArquivo($fileArray, $caminho)
    {
        if ($fileArray['error'] == 0) {

            $name     = $fileArray['name']; //Atribui uma array com os nomes dos arquivos à variável
            $tmp_name = $fileArray['tmp_name']; //Atribui uma array com os nomes temporários dos arquivos à variável

            $allowedExts = array("pdf", "jpeg", "jpg"); //Extensões permitidas

            $dir = $caminho;
            $ext = pathinfo($name, PATHINFO_EXTENSION);

            if (in_array($ext, $allowedExts)) { //Pergunta se a extensão do arquivo, está presente no array das extensões permitidas
                // $new_name = date("Y.m.d-H.i.s") . '.' . $ext;

                self::$resultado = move_uploaded_file($fileArray['tmp_name'], $dir . '/' . $name); //Fazer upload do arquivo
            }
        }

        return self::$resultado;
    }

    public function enviaArquivoDiversos($fileArray, $caminho)
    {
        if ($fileArray['error'] == 0) {

            $name     = $fileArray['name']; //Atribui uma array com os nomes dos arquivos à variável
            $tmp_name = $fileArray['tmp_name']; //Atribui uma array com os nomes temporários dos arquivos à variável

            $allowedExts = array("pdf", "jpeg", "jpg", "png", "txt", "doc", "docx"); //Extensões permitidas

            $dir = $caminho;
            $ext = pathinfo($name, PATHINFO_EXTENSION);

            if (in_array($ext, $allowedExts)) { //Pergunta se a extensão do arquivo, está presente no array das extensões permitidas
                // $new_name = date("Y.m.d-H.i.s") . '.' . $ext;

                self::$resultado = move_uploaded_file($fileArray['tmp_name'], $dir . '/' . $name); //Fazer upload do arquivo
            }
        }

        return self::$resultado;
    }

    public function enviaArquivoAlvara($fileArray, $caminho)
    {
        if ($fileArray['error'] == 0) {

            $name     = $fileArray['name']; //Atribui uma array com os nomes dos arquivos à variável
            $tmp_name = $fileArray['tmp_name']; //Atribui uma array com os nomes temporários dos arquivos à variável

            $allowedExts = array("pdf", "jpeg", "jpg"); //Extensões permitidas

            $dir = $caminho;
            $ext = pathinfo($name, PATHINFO_EXTENSION);

            if (in_array($ext, $allowedExts)) { //Pergunta se a extensão do arquivo, está presente no array das extensões permitidas
                $new_name = 'ALVARA.' . $ext;

                self::$resultado = move_uploaded_file($fileArray['tmp_name'], $dir . '/' . $new_name); //Fazer upload do arquivo
            }
        }

        return self::$resultado;
    }

    public function uploadArquivo($fileArray, $caminho, $nomeArquivo = 'fileUpload')
    {
        if (isset($fileArray[$nomeArquivo])) {

            $name     = $fileArray[$nomeArquivo]['name']; //Atribui uma array com os nomes dos arquivos à variável
            $tmp_name = $fileArray[$nomeArquivo]['tmp_name']; //Atribui uma array com os nomes temporários dos arquivos à variável

            $allowedExts = array(".pdf", ".jpeg", ".jpg", ".pfx"); //Extensões permitidas

            $dir = $caminho;
            $ext = strtolower(substr($name,-4));

            if (in_array($ext, $allowedExts)) { //Pergunta se a extensão do arquivo, está presente no array das extensões permitidas
                $new_name = date("Y.m.d-H.i.s") . $ext;

                self::$resultado = move_uploaded_file($fileArray[$nomeArquivo]['tmp_name'], $dir.'/'.$name); //Fazer upload do arquivo
            }
        }

        return self::$resultado;
    }

    public static function uploadGuia($fileArray, $caminho, $nomeArquivo)
    {
        if (isset($fileArray['fileUpload'])) {
            $name     = $fileArray['fileUpload']['name']; //Atribui uma array com os nomes dos arquivos à variável
            $tmp_name = $fileArray['fileUpload']['tmp_name']; //Atribui uma array com os nomes temporários dos arquivos à variável

            $allowedExts = array(".pdf", ".jpeg", ".jpg"); //Extensões permitidas

            $dir = $caminho;
            $ext = strtolower(substr($name,-4));

            if (in_array($ext, $allowedExts)) { //Pergunta se a extensão do arquivo, está presente no array das extensões permitidas
                // $novoNome = $empresasId . '-' . $tipoGuia . $ext;
                //$new_name = date("Y.m.d-H.i.s") . $ext;

                self::$resultado = move_uploaded_file($fileArray['fileUpload']['tmp_name'], $dir.'/'.$nomeArquivo); //Fazer upload do arquivo
            }
        }

        return self::$resultado;
    }
}
