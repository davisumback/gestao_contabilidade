<?php
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Cadastro de Prospects");
require_once('menu-left.php');
require_once('../cabecalho.php');

$usuariosId = $_SESSION['id_usuario'];

$dao = new \App\Model\Prospect\Prospect();
$prospects = $dao->allProspects($usuariosId);

?>

<div class="container-fluid">
    <div class="card border-success rounded">
        <div class="card-header bg-success text-center text-white font-weight-bold">
            Todos os Prospects :)
        </div>
        <div class="card-body">
            <div class="container">
                <?=\App\Helper\Mensagem::getMensagem($_COOKIE, 'resultadoDadosProspect', 'mensagemDadosProspect')?>
            </div>
            <div class="text-right">
                <button data-toggle="modal" data-target="#novo-prospect" class="btn btn-padrao btn-success mb-4 font-weight-bold">Novo Prospect</button>
            </div>
            <div class="table-responsive mb-5">
                <table id="myTable" class="table table-hover">
                    <thead class="label-cadastro">                   
                        <tr class="table-success">
                            <th scope="col">Doutor</th>
                            <th scope="col">Contato</th>
                            <th scope="col">Email</th>
                            <th scope="col">Celular</th>
                            <th scope="col" class="text-nowrap">Cadastrado por</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="label-cadastro">
                        <?php foreach ($prospects as $prospect) : ?>
                            <tr style="cursor:pointer;">
                                <td onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['nome_doutor']?></td>
                                <td onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['nome_contato']?></td>
                                <td onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['email']?></td>
                                <td class="text-nowrap" onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=Helpers::mask($prospect['celular'], '(##) #####-####')?></td>
                                <td onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['usuarios_id']?></td>
                                <td class="text-nowrap" style="cursor:auto">
                                    <button type="button" class="btn btn-primary btn-padrao btn-warning btn-sm font-weight-bold" 
                                        data-toggle="modal" 
                                        data-target="#editaProspect"
                                        data-prospect-id="<?=$prospect['id']?>"
                                        data-prospect-nome="<?=$prospect['nome_doutor']?>"
                                        data-prospect-contato="<?=$prospect['nome_contato']?>"
                                        data-prospect-email="<?=$prospect['email']?>"
                                        data-prospect-celular="<?=$prospect['celular']?>"
                                        data-prospect-cnpj="<?=$prospect['cnpj']?>"
                                        data-prospect-nome-empresa="<?=$prospect['nome_empresa']?>"
                                        data-prospect-profissao="<?=$prospect['profissao']?>">
                                        Editar
                                    </button>
                                    <button type="button" class="btn btn-primary btn-padrao btn-danger btn-sm font-weight-bold" 
                                        data-toggle="modal" 
                                        data-target="#deletaProspect"
                                        data-prospect-id="<?=$prospect['id']?>"
                                        data-prospect-nome="<?=$prospect['nome_doutor']?>"
                                        data-prospect-contato="<?=$prospect['nome_contato']?>"
                                        data-prospect-email="<?=$prospect['email']?>"
                                        data-prospect-celular="<?=$prospect['celular']?>">
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
</div>

<?php include __DIR__ . '/../modal/prospect/insere.php'; ?>
<?php include __DIR__ . '/../modal/prospect/edita.php'; ?>
<?php include __DIR__ . '/../modal/prospect/deleta.php'; ?>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    $(document).ready( function () {
        $('#myTable').DataTable( {
            language: {
                search:         "Pesquisar",
                lengthMenu:     "Mostrar _MENU_ Prospects",
                infoPostFix:    "",
                info:           "Mostrando _START_ de _END_ do total de _TOTAL_ prospects",
                loadingRecords: "Carregando...",
                zeroRecords:    "Nenhum dado encontrado",
                emptyTable:     "Nenhum dado encontrado",
                paginate: {
                    first:      "Primeiro",
                    previous:   "Anterior",
                    next:       "Próximo",
                    last:       "Último"
                },
                aria: {
                    sortAscending:  ": activer pour trier la colonne par ordre croissant",
                    sortDescending: ": activer pour trier la colonne par ordre décroissant"
                }
            }
        });

        $('#cnpj').mask('00.000.000/0000-00');
        $('#telefone').mask('(00) 0000-0000');
        $('#celular').mask('(00) 00000-0000');
    } );
</script>

<script>
    $('#editaProspect').on('show.bs.modal', function (event) {        
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('prospect-id'); // Extract info from data-* attributes
        var nome = button.data('prospect-nome'); // Extract info from data-* attributes
        var email = button.data('prospect-email'); // Extract info from data-* attributes
        var contato = button.data('prospect-contato'); // Extract info from data-* attributes
        var celular = button.data('prospect-celular'); // Extract info from data-* attributes
        var cnpj = button.data('prospect-cnpj'); // Extract info from data-* attributes
        var nomeEmpresa = button.data('prospect-nome-empresa'); // Extract info from data-* attributes
        var profissao = button.data('prospect-profissao'); // Extract info from data-* attributes
        // var valor = button.data('cidade-ies') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        //modal.find('.modal-title').text('New message to ')
        modal.find('#prospectId').val(id);
        modal.find('#prospectNome').val(nome);
        modal.find('#prospectEmail').val(email);
        modal.find('#prospectContato').val(contato);
        modal.find('#prospectCelular').val(celular);
        modal.find('#prospectCnpj').val(cnpj);
        modal.find('#prospectNomeEmpresa').val(nomeEmpresa);
        modal.find('#propectProfissao').val(profissao);
        // modal.find('#altera-cidade-ies').val(valor)
        
        $('#prospectCelular').mask('(00) 00000-0000');
        $('#prospectCnpj').mask('##.###.###/####-##');
    });

    $('#deletaProspect').on('show.bs.modal', function (event) {        
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('prospect-id'); // Extract info from data-* attributes
        var nome = button.data('prospect-nome'); // Extract info from data-* attributes
        var email = button.data('prospect-email'); // Extract info from data-* attributes
        var contato = button.data('prospect-contato'); // Extract info from data-* attributes
        var celular = button.data('prospect-celular'); // Extract info from data-* attributes
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        //modal.find('.modal-title').text('New message to ')
        modal.find('#prospectId').val(id);
        modal.find('#prospectNome').val(nome);
        modal.find('#prospectEmail').val(email);
        modal.find('#prospectContato').val(contato);
        modal.find('#prospectCelular').val(celular);

        $('#prospectCelular').mask('(00) 00000-0000');
    });
</script>