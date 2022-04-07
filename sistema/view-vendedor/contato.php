<?php
use App\Model\Contato;
use App\Helper\Helpers;
use App\Helper\Mensagem;
use App\Arquivo\NavegadorArquivos;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Cadastrar contato ;)");
require_once('menu-left.php');
require_once('../cabecalho.php');

$user = $_SESSION['id_usuario'];

$contato = new \App\Model\Contato();
$contatos = $contato->getContatosUsuario($user);
?>

<div id="carregando" class="center" hidden>
    <div class="loading">
    </div>
</div>

<div class="container" id="conteudo">
    <div class="alert alert-light text-center pt-4 pb-4" role="alert">
        <strong class="label-cadastro">Área para edição de todos os contatos do nosso sistema.</strong>
    </div>

    <div class="text-center mb-5">
        <?=Mensagem::getMensagem($_COOKIE, 'insercaoContato', 'mensangemInsercaoContato');?>
    </div>

    <div class="text-right mb-3">
        <button data-toggle="modal" data-target="#novo-contato" class="btn btn-success btn-padrao font-weight-bold" type="submit">Novo Contato</button>
    </div>
    
    <?php if (empty($contatos)) : ?>
        <div class="alert alert-light text-center pt-4 pb-4" role="alert">
            <strong class="text-danger">Não há contatos cadastrados.</strong>
        </div>
    <?php else : ?>    
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-success label-cadastro">
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Email</th>
                                <th scope="col">Telefone</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="texto-table">
                            <?php foreach ($contatos as $contato) : ?>
                                <tr>
                                    <td><?=$contato['nome']?></td>
                                    <td><?=$contato['email']?></td>
                                    <td class="text-nowrap"><?=\App\Helper\Helpers::mask($contato['telefone'], '(##) #####-####');?></td>                            
                                    <td class="text-center text-nowrap">
                                        <button                                        
                                            data-toggle="modal"
                                            data-target="#alteraContato"
                                            data-id="<?=$contato['id']?>"
                                            data-nome-contato="<?=$contato['nome']?>"
                                            data-email-contato="<?=$contato['email']?>"
                                            data-telefone-contato="<?=\App\Helper\Helpers::mask($contato['telefone'], '(##) #####-####');?>"
                                            type="button"
                                            class="btn btn-padrao btn-warning btn-sm">
                                                Editar
                                        </button>
                                        <button
                                            data-toggle="modal"
                                            data-target="#deleta-contato"
                                            data-id="<?=$contato['id']?>"
                                            type="button"
                                            class="btn btn-danger btn-sm btn-edita-usuario">
                                                Deletar
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

<?php include __DIR__ . '/../modal/contato/insere.php'; ?>
<?php include __DIR__ . '/../modal/contato/edita.php';  ?>
<?php include __DIR__ . '/../modal/contato/deleta.php'; ?>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    $('#deleta-contato').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var modal = $(this)
        modal.find('#id-deleta-contato').val(id)
    });

    $('#alteraContato').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var nome = button.data('nome-contato')
        var email = button.data('email-contato')
        var telefone = button.data('telefone-contato')

        var modal = $(this)

        modal.find('#id-altera-contato').val(id)
        modal.find('#altera-nome-contato').val(nome)
        modal.find('#altera-email-contato').val(email)
        modal.find('#altera-telefone-contato').val(telefone)
    });

    $('#telefone-contato').mask('(00) 00000-0000');
    $('#altera-telefone-contato').mask('(00) 00000-0000');
</script>