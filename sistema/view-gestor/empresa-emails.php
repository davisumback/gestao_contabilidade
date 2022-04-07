<?php
use App\DAO\EmpresaEmailDAO;
use App\Helper\Mensagem;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao($_SESSION['viewIdEmpresa'] . ' | ' . $_SESSION['viewNomeEmpresa']);

if (!array_key_exists('viewIdEmpresa', $_SESSION)) {
    header("Location: empresa-pesquisa.php");
    die();
}

require_once('menu-left.php');
require_once('../cabecalho.php');

$empresaId = $_SESSION['viewIdEmpresa'];
$empresaEmailDao = new EmpresaEmailDAO();
$emails = $empresaEmailDao->getEmpresaEmails($empresaId);
?>

<div class="alert alert-light text-center pt-4 pb-4" role="alert">
    <strong class="label-cadastro">Área para edição dos emails da Empresa.</strong>
</div>

<?=Mensagem::getMensagem($_COOKIE, 'insercaoEmail', 'mensagemInsercaoEmail');?>


<div class="card">
    <div class="card-body">
        <div class="text-right mb-3">
            <button data-toggle="modal" data-target="#novo-email" class="btn btn-success btn-padrao font-weight-bold" type="button">Novo Email</button>
        </div>
        <div class="table-responsive">
            <table class="table table-sm">
                <tbody class="texto-table">
                    <?php foreach ($emails as $email) : ?>
                        <tr>
                            <td class="label-cadastro border-top-0"><?=$email['email']?></td>
                            <td class="border-top-0">
                                <button
                                    data-toggle="modal"
                                    data-target="#edita-email"
                                    data-edita-id="<?=$email['id']?>"
                                    data-edita-email="<?=$email['email']?>"
                                    type="button"
                                    class="btn btn-padrao btn-warning btn-sm font-weight-bold">
                                        Editar
                                </button>
                                <button
                                    data-toggle="modal"
                                    data-target="#deleta-email"
                                    data-deleta-id="<?=$email['id']?>"
                                    type="button"
                                    class="btn btn-padrao btn-danger btn-sm font-weight-bold">
                                        Apagar
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../modal/empresa/email/insere-email.php'; ?>
<?php include __DIR__ . '/../modal/empresa/email/edita-email.php'; ?>
<?php include __DIR__ . '/../modal/empresa/email/deleta-email.php'; ?>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    $('#deleta-email').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('deleta-id') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        //modal.find('.modal-title').text('New message to ')
        modal.find('#deleta-id').val(id)
    })

    $('#edita-email').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('edita-id') // Extract info from data-* attributes
        var email = button.data('edita-email') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        //modal.find('.modal-title').text('New message to ')
        modal.find('#edita-id').val(id)
        modal.find('#edita-email').val(email)
    })
</script>