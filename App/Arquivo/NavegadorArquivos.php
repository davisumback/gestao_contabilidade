<?php

namespace App\Arquivo;

class NavegadorArquivos{
    const DIRETORIO_BASE = '../../grupobfiles/empresas/';
    const DIRETORIO_CONTROLLER = '../controllers/navegador-arquivos/';
    const ARQUIVO_APAGA_TUDO = 'apaga-tudo.php';
    private static $diretorioEmpresa;
    private static $caminhoDir;
    private static $diretorioAtual;
    private static $backDir;
    private static $nomeDaPagina;

    public static function setDiretorioEmpresa($pastaEmpresa){
        self::$diretorioEmpresa = self::DIRETORIO_BASE . $pastaEmpresa . '/';
    }

    public static function setNomeDaPagina($nome){
        self::$nomeDaPagina = $nome;
    }

    public static function getCaminhoDiretorioAtual($get){
        self::$caminhoDir = (array_key_exists('dir', $get) && $get['dir'] != '') ? $get['dir'] : self::$diretorioEmpresa;
        return self::$caminhoDir;
    }

    public static function isDiretorioVazio($pastaAPesquisar){
        $scan = scandir(self::$caminhoDir.$pastaAPesquisar);
        return $scan = (count($scan) <= 2);
    }

    public static function abreDiretorioAtual(){
        self::$diretorioAtual = dir(self::$caminhoDir);
    }

    public static function getCaminhoVoltar(){
        $strrdir = strrpos(substr(self::$caminhoDir, 0, -1), '/');
        return self::$backDir = substr(self::$caminhoDir, 0, $strrdir+1);
    }

    public static function criaMenuNavegacao(){
        $htmlMenu = '';

        $isPastaImpostos = strpos(self::$caminhoDir, 'impostos');

        if(self::$caminhoDir == self::$diretorioEmpresa){
            $htmlMenu = '   <div class="pt-3">
                                <a class="ml-5"  data-toggle="modal" data-target="#cria-pasta">
                                    <i class="label-cadastro fas fa-plus-square icones-menu-navegador-arquivos"></i>
                                </a>
                            </div>';
        }

        if(self::$caminhoDir != self::$diretorioEmpresa){
            $htmlMenu = '   <div class="pt-3">
                                <a href="'.self::$nomeDaPagina.'?dir='.self::$backDir.'" class="gif-loading">
                                    <i class="fas fa-arrow-left icones-menu-navegador-arquivos"></i>
                                </a>
                                <a class="ml-5" data-toggle="modal" data-target="#cria-pasta">
                                    <i class="fas fa-plus-square icones-menu-navegador-arquivos"></i>
                                </a>
                                <a class="ml-5" data-toggle="modal" data-target="#upload-arquivos">
                                    <i class="fas fa-file-upload icones-menu-navegador-arquivos"></i>
                                </a>
                            </div>';
        }

        if($isPastaImpostos !== false){
            $htmlMenu = '   <div class="pt-3">
                                <a href="'.self::$nomeDaPagina.'?dir='.self::$backDir.'" class="gif-loading">
                                    <i class="fas fa-arrow-left icones-menu-navegador-arquivos"></i>
                                </a>
                            </div>';
        }

        $htmlMenu .= '  <div class="row">
                            <div class="col-12">
                                <div class="linha"></div>
                            </div>
                        </div>';

        return $htmlMenu;
    }

    public static function criaNavegadorDeArquivos(){
        self::abreDiretorioAtual();
        $html = '';

        while ($arquivo = self::$diretorioAtual->read()) {
            if ($arquivo != '.' && $arquivo != '..' && $arquivo != 'lost+found') {
                $urlArquivo = str_replace(" ", "%20", $arquivo);

                if (is_dir(self::$caminhoDir.$arquivo)) {
                    $modeloPasta = (self::isDiretorioVazio($arquivo)) ? '<i class="far fa-folder card-incone-pastas"></i>' : '<i class="fas fa-folder card-incone-pastas"></i>';
                    $caminhoDeletar = self::DIRETORIO_CONTROLLER.self::ARQUIVO_APAGA_TUDO."?dir=".self::$caminhoDir.$urlArquivo.'/';
                    $html .= '  <div class="col-3 text-center">
                                    <div class="card card-pastas">
                                        <div class="card-body text-center card-teste">
                                            <a href="'.self::$nomeDaPagina.'?dir='.self::$caminhoDir.$urlArquivo.'/" class="gif-loading">'.$modeloPasta.'</a>
                                            <h6 class="card-subtitle mb-2 text-muted card-nome-pasta">'.$arquivo.'</h6>
                                        </div>
                                        <div class="text-center div-icone-remover">
                                            <a onclick=apagaArquivo("'.$caminhoDeletar.'")><i class="far fa-trash-alt card-icone-remover"></i></a>
                                        </div>
                                    </div>
                                </div>';
                } else {
                    $caminhoDeletar = self::DIRETORIO_CONTROLLER.self::ARQUIVO_APAGA_TUDO."?dir=".self::$caminhoDir.$urlArquivo.'&a=1';
                    $html .= '  <div class="col-3 text-center">
                                    <div class="card card-pastas">
                                        <div class="card-body text-center">
                                            <a arquivo" href="'.self::$caminhoDir.$urlArquivo.'" target="_blank"><i class="fas fa-file card-incone-pastas"></i></a></td>
                                            <h6 class="card-subtitle mb-2 text-muted card-nome-pasta">'.$arquivo.'</h6>
                                        </div>
                                        <div class="text-center div-icone-remover">
                                            <a onclick=apagaArquivo("'.$caminhoDeletar.'")><i class="far fa-trash-alt card-icone-remover"></i></a>
                                        </div>
                                    </div>
                                </div>';
                }
            }
        }
        $html .= '';

        return $html;
    }

    public static function liberaDiretorio(){
        self::$diretorioAtual->close();
    }
}
