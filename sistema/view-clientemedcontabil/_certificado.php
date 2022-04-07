<?php
use App\Helper\Mensagem;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao('Certificado');
require_once('menu-left.php');
require_once('../template-medcontabil/cabecalho.php');

$empresasId = $_SESSION['empresasId'];
$empresaCertificado = new \App\Model\Empresa\Certificado();
$certificados = $empresaCertificado->getEmpresaCertificados($empresasId);

?>

<div class="container-fluid">
    <div class="text-center mb-3">
        <button class="btn btn-padrao btn-cor-primaria" data-toggle="modal" data-target="#insereCertificado">Cadastrar</button>
    </div>

    <?php Mensagem::getMensagem($_COOKIE, 'insercaoCertificado', 'mensagemInsercaoCertificado'); ?>
</div>

<?php if (! empty($certificados)) : ?>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-success label-cadastro">
                        <tr>
                            <th>Arquivo</th>
                            <th>Senha</th>
                            <th>Validade</th>
                        </tr>
                    </thead>

                    <tbody class="texto-table">
                        <?php foreach ($certificados as $certificado) : ?>
                            <tr>
                                <td class="label-cadastro"><?=$certificado['arquivo']?></td>
                                <td class="label-cadastro"><?=$certificado['senha']?></td>
                                <td class="label-cadastro"><?=Helpers::formataDataView($certificado['validade'], '00/00/000')?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="alert alert-light text-center pt-4 pb-4" role="alert">
        <strong class="text-danger">Nenhum certificado cadastrado.</strong>
    </div>
<?php endif ?>

<?php
require_once('rodape.php');
require_once('../template-medcontabil/rodape.php');
?>