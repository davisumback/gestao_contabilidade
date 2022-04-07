<?php
use App\Helper\Helpers;
use App\Helper\Mensagem;
use App\Arquivo\NavegadorArquivos;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Upload de Arquivos :)");
require_once('menu-left.php');
require_once('../cabecalho.php');

$arquivoRetorno = 'upload-arquivos.php'
?>

<div id="carregando" class="center display-none">
    <div class="loading">
    </div>
</div>

<div class="container-fluid pb-3">

    <div class="text-center mt-5">
        <?=Mensagem::getMensagem($_COOKIE, 'insercaoEmpresaController', 'mensagemEmpresaController');?>
    </div>

</div>

<div class="container-fluid">
    <div class="content " id="conteudo">
        <div class="row justify-content-around">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-cor-accent-primaria text-center">
                        <i class="fas fa-file-upload"></i><strong class="card-title pl-md-2">Upload de Arquivos</strong>
                    </div>
                    <div class="card-body">

                        <form id="form" class="needs-validation-loading" action="../controllers/empresa/envia-arquivo.php" enctype="multipart/form-data" method="post" autocomplete="none" novalidate>
                            <input name="usuario_id" value="<?=$_SESSION['id_usuario']?>" hidden>
                            <input name="arquivoRetorno" value="<?=$arquivoRetorno?>" hidden>
                            <input name="method" value="storeDiversos" hidden>

                            <div class="row justify-content-around mt-3 mb-3">
                                <div class="col-md-2 label-cadastro text-center">
                                    <div>
                                        <label>Nº Empresa *</label>
                                        <input class="form-control text-center" type="text" name="empresaId" required>
                                        <div class="invalid-feedback">
                                            Digite o número da empresa
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3 mb-3" id="div-upload">
                                <div class="col-md-6 label-cadastro">
                                    <div>
                                        <label >Arquivo *</label>
                                        <input id="input-upload" class="form-control" type="file" name="fileUpload" required>
                                        <div class="invalid-feedback">
                                            Escolha um arquivo
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3 mb-3">
                                <div class="col-md-12 label-cadastro">
                                    <label for="">Descrição *</label>
                                    <textarea class="form-control" rows="5" type="text" name="descricao" required></textarea>
                                    <div class="invalid-feedback">
                                        Digite uma descrição
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-padrao btn-success font-weight-bold">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>
