<?php
use App\Helper\Mensagem;
use App\Helper\Helpers;
use App\DAO\CertificadoDAO;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao('Certificados');
require_once('menu-left.php');
require_once('../cabecalho.php');

$mensagem = null;
$empresaResult = null;

$dao = new CertificadoDAO();
$certificados = $dao->all();
?>

<div class="container-fluid">            
    <div class="text-right py-2">
        <button class="btn btn-padrao btn-success font-weight-bold" data-toggle="modal" data-target="#insereCertificado">Novo Certificado</button>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-success">
                <div class="card-header text-center bg-cor-primaria rounded-0">
                    <strong class="card-title  text-white">Certificados Cadastrados</strong>
                </div>                
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table">
                            <thead>
                                <tr class="label-cadastro">
                                    <th scope="col" class="border-top-0">Empresa</th>
                                    <th scope="col" class="border-top-0">Validade</th>
                                    <th scope="col" class="border-top-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($certificados as $certificado) : ?>
                                    <tr style="cursor:pointer">
                                        <td class="text-secondary font-weight-bold"><?= $certificado->getEmpresasId() ?></td>
                                        <td class="text-secondary font-weight-bold"><?= Helpers::formataDataView($certificado->getValidade(), '00/00/0000') ?></td>
                                        <td class="text-right">
                                            <button 
                                                data-toggle="modal"
                                                data-target="#alteraCertificado"
                                                data-empresas-id="<?= $certificado->getEmpresasId() ?>"
                                                data-validade="<?= $certificado->getValidade() ?>"
                                                data-senha="<?= $certificado->getSenha() ?>"
                                                data-id-integracao="<?= $certificado->getIdIntegracao() ?>"
                                                type="button" 
                                                class="btn btn-padrao btn-sm btn-warning font-weight-bold">
                                                    Editar
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>                   
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../modal/certificado/insere.php'; ?>
<?php include __DIR__ . '/../modal/certificado/edita.php'; ?>

<?php 
require_once('rodape.php');
require_once('../rodape.php');
?>

<script>
    $('#alteraCertificado').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var empresasId = button.data('empresas-id')
        var validade = button.data('validade')
        var senha = button.data('senha')
        var idIntegracao = button.data('id-integracao')

        var modal = $(this)

        modal.find('#empresas-id').val(empresasId)
        modal.find('#validade').val(validade)
        modal.find('#senha').val(senha)
        modal.find('#id-integracao').val(idIntegracao)

        $("#validade").mask("00/00/0000");
    })
</script>