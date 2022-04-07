<?php
use App\Helper\Mensagem;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao('Contas Bancárias :)');
require_once('menu-left.php');
require_once('../template-medcontabil/cabecalho.php');

$arquivoRetorno = 'empresa-contabancaria.php';

$empresaId = $_SESSION['empresasId'];
$empresaContaBancaria = new \App\Model\Empresa\EmpresaContaBancaria();
$contasBancarias = $empresaContaBancaria->getContasBancarias($empresaId);
$bancos = $empresaContaBancaria->getBancos();
?>

<div class="alert alert-light text-center pt-4 pb-4" role="alert">
    <strong class="label-cadastro">Contas Bancárias da Empresa.</strong>
</div>

<?=Mensagem::getMensagem($_COOKIE, 'resultadoInsercaoConta', 'mensagemInsercaoConta');?>

<div class="text-right mb-3">
    <button data-toggle="modal" data-target="#insere-nova-conta-bancaria" class="btn btn-padrao btn-cor-primaria" type="button"><strong>Nova Conta Bancária</strong></button>
</div>

<?php if (! empty($contasBancarias)) : ?>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-info label-cadastro">
                        <tr>
                            <th style="border:none">Padrão</th>
                            <th style="border:none">Banco</th>
                            <th style="border:none">Agência</th>
                            <th style="border:none">Conta</th>
                            <th style="border:none">Dígito</th>
                            <th style="border:none">Tipo</th>
                            <th style="border:none">Categoria</th>
                            <th style="border:none"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($contasBancarias as $contaBancaria) : ?>
                            <tr>
                                <td class="label-cadastro">
                                    <form class="needs-validation-loading mb-0" action="../controllers/empresa/conta-bancaria.php">
                                        <input name="method" value="updateContaPadrao" hidden>
                                        <input name="contaBancariaId" value="<?=$contaBancaria['id']?>" hidden>
                                        <input name="empresasId" value="<?=$empresaId?>" hidden>
                                        <input name="arquivoRetorno" value="<?=$arquivoRetorno?>" hidden>
                                        <?php
                                            $disable = '';
                                            $class = 'btn btn-sm btn-outline-info btn-padrao';                                            
                                            $textoBotao = 'Tornar padrão';                                             
                                            if ($contaBancaria['conta_padrao'] == 'SIM') {
                                                $disable = 'disabled';
                                                $class = 'btn btn-sm btn-padrao btn-info';
                                                $textoBotao = 'Padrão';
                                            }
                                        ?>
                                        <button class="<?=$class?>" <?=$disable?>>
                                            <strong><?=$textoBotao?></strong>   
                                        </button>
                                    </form>
                                </td>
                                <td class="label-cadastro"><?=$contaBancaria['nome']?></td>
                                <td class="label-cadastro"><?=$contaBancaria['agencia']?></td>
                                <td class="label-cadastro"><?=$contaBancaria['numero']?></td>
                                <td class="label-cadastro"><?=$contaBancaria['digito']?></td>
                                <td class="label-cadastro"><?=$empresaContaBancaria->decideTipoConta($contaBancaria['tipo'])?></td>
                                <td class="label-cadastro"><?=$empresaContaBancaria->decideCategoriaConta($contaBancaria['pessoa'])?></td>
                                <td class="label-cadastro">
                                    <button
                                        data-toggle="modal"
                                        data-target="#deleta"
                                        data-deleta-conta="<?=$contaBancaria['id']?>"
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
<?php else : ?>
    <div class="alert alert-light text-center pt-4 pb-4" role="alert">
        <strong class="text-danger">Nenhuma conta cadastrada.</strong>
    </div>
<?php endif ?>

<?php include __DIR__ . '/../modal/empresa/conta-bancaria/insere-nova.php'; ?>
<?php include __DIR__ . '/../modal/empresa/conta-bancaria/deleta.php'; ?>

<?php
require_once('rodape.php');
require_once('../template-medcontabil/rodape.php');
?>

<script type="text/javascript">
    $('#deleta').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('deleta-conta') // Extract info from data-* attributes
        
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        //modal.find('.modal-title').text('New message to ')
        modal.find('#deleta-conta').val(id)
    })
</script>

<script src="../assets/custom-js/autocomplete.js"></script>

<script>
    var bancos = [];
    <?php foreach ($bancos as $banco) : ?>
        bancos.push('<?=$banco['nome'] . ' - ' . $banco['cod']?>');
    <?php endforeach ?>
    autocomplete(document.getElementById("input-banco"), bancos);
</script>