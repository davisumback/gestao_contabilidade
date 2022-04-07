<?php
use App\Helper\Helpers;
use App\DAO\EmpresaDAO;
use App\Helper\Mensagem;
use App\DAO\EmpresaAcessoDAO;
use App\DAO\EmpresasPlanosDAO;
use App\DAO\EmpresaUsuarioCongDAO;
use App\Arquivo\NavegadorArquivos;

require_once('header.php');
require_once('menu-topo.php');

if (!array_key_exists('viewIdEmpresa', $_SESSION)) {
    header("Location: empresa-pesquisa.php");
    die();
}

$menu_topo->setTituloNavegacao($_SESSION['viewIdEmpresa'] . ' | ' . $_SESSION['viewNomeEmpresa']);
require_once('menu-left.php');
require_once('../cabecalho.php');

$funcionario = new \App\Model\Empresa\Funcionario();
$funcionarios = $funcionario->getFuncionariosEmpresa($_SESSION['viewIdEmpresa']);
?>

<div class="container-fluid pb-5">

    <div class="alert alert-light text-center pt-4 pb-4" role="alert">
        <strong class="label-cadastro">Área para cadastro de funcionários.</strong>
    </div>

    <?=Mensagem::getMensagem($_COOKIE, 'insercaoFuncionario', 'mensagemInsercaoFuncionario');?>
    
    <div class="row mb-3">
        <div class="col-12 mx-auto text-right mt-2 mb-2">
            <button class="btn btn-success bg-green btn-padrao" data-toggle="modal" data-target="#insereFuncionario">Inserir Funcionário</button>
        </div>
    </div>

    <?php if (empty($funcionarios)) : ?>
        <div class="alert alert-light text-center pt-4 pb-4" role="alert">
            <strong class="text-danger">Nenhum Funcionário cadastrado.</strong>
        </div>

    <?php else : ?>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-success label-cadastro">
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">CPF</th>                   
                                <th scope="col">Salário</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>

                        <tbody class="texto-table">
                            <?php foreach ($funcionarios as $funcionario) : ?>
                                <tr>
                                    <td><?=$funcionario['nome']?></td>
                                    <td><?= Helpers::mask($funcionario['cpf'], '###.###.###-##')?></td>
                                    <td>R$ <?= Helpers::formataMoedaView($funcionario['salario'])?></td>
                                    <td>
                                        <button
                                            data-toggle="modal"
                                            data-target="#edita"
                                            data-funcionario-id = "<?=$funcionario['id']?>"
                                            data-edita-funcionario = "<?=$funcionario['salario']?>"
                                            type="button"
                                            class="btn btn-padrao btn-warning btn-sm">
                                                Editar
                                        </button>
                                        <button
                                            data-toggle="modal"
                                            data-target="#deleta"
                                            data-deleta-funcionario="<?=$funcionario['id']?>"
                                            type="button"
                                            class="btn btn-padrao btn-danger btn-sm">
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
    <?php endif ?>
</div>

<?php include __DIR__ . '/../modal/empresa/funcionario/insere.php'; ?>
<?php include __DIR__ . '/../modal/empresa/funcionario/edita.php'; ?>
<?php include __DIR__ . '/../modal/empresa/funcionario/deleta.php'; ?>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    $('#edita').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('edita-funcionario');
        var funcionarioId = button.data('funcionario-id');
        
        var modal = $(this);
        modal.find('.salario-funcionario').val(id);
        modal.find('#funcionariosId').val(funcionarioId);
    });

    $('#deleta').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('deleta-funcionario');
        
        var modal = $(this);
        modal.find('#deleta-funcionario').val(id);
    });
</script>

<script type="text/javascript">
    $('#cpf').mask('000.000.000-00');
    $('.salario-funcionario').mask('000.000.000,00', {reverse: true});
</script>