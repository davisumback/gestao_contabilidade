<?php
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Cadastro de Prospects");
require_once('menu-left.php');
require_once('../template-medcontabil/cabecalho.php');

$usuariosId = $_SESSION['id_usuario'];

$dao = new \App\DAO\ProspectDAO();
$prospects = $dao->allPorUsuario($usuariosId);
?>

<div class="container-fluid">
    <div class="alert alert-light text-center pt-4 pb-4" role="alert">
        <strong class="text-dark-blue">Todos os Prospects :)</strong>
    </div>

    <div class="text-center">
        <button data-toggle="modal" data-target="#novo-prospect" class="btn btn-padrao btn-cor-primaria mb-4">Novo Prospect</button>
    </div>

    <div class="container">
        <?=\App\Helper\Mensagem::getMensagem($_COOKIE, 'resultadoDadosProspect', 'mensagemDadosProspect')?>
    </div>

    <div class="table-responsive mb-5">
        <table id="myTable" class="table table-hover">
            <thead class="label-cadastro">                   
                <tr class="bg-cor-accent-primaria">
                    <th scope="col">Doutor</th>
                    <th scope="col">Contato</th>
                    <th scope="col">Email</th>
                    <th scope="col">Celular</th>
                    <th class="text-nowrap" scope="col">Nome Empresa</th>
                    <th scope="col">CNPJ</th>
                    <th scope="col">Profissão</th>
                    <th scope="col">Especialidade</th>
                    <th scope="col"></th>

                </tr>
            </thead>

            <tbody class="text-dark-blue font-weight-bold">
                <?php foreach ($prospects as $prospect) : ?>
                    <tr style="cursor:pointer;" >
                        <td onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['nome_doutor']?></td>
                        <td onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['nome_contato']?></td>
                        <td onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['email']?></td>
                        <td class="text-nowrap" onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=Helpers::mask($prospect['celular'], '(##) #####-####')?></td>
                        <td onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['nome_empresa']?></td>
                        <td class="text-nowrap" onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=Helpers::mask($prospect['cnpj'], '###.###.##/####-##')?></td>
                        <td onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['profissao']?></td>
                        <td onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['especialidade']?></td>
                        <td class="text-nowrap" style="cursor:auto">
                            <button type="button" class="btn btn-padrao btn-info btn-sm font-weight-bold" 
                                data-toggle="modal" 
                                data-target="#editaProspect"
                                data-prospect-id="<?=$prospect['id']?>"
                                data-prospect-nome="<?=$prospect['nome_doutor']?>"
                                data-prospect-contato="<?=$prospect['nome_contato']?>"
                                data-prospect-email="<?=$prospect['email']?>"
                                data-prospect-celular="<?=$prospect['celular']?>"
                                data-prospect-telefone="<?=$prospect['telefone']?>"
                                data-prospect-nome-empresa="<?=$prospect['nome_empresa']?>"
                                data-prospect-cnpj="<?=$prospect['cnpj']?>"
                                data-prospect-profissao="<?=$prospect['profissao']?>"
                                data-prospect-especialidade="<?=$prospect['especialidade']?>">
                                Editar
                            </button>
                            <button type="button" class="btn btn-padrao btn-danger btn-sm font-weight-bold" 
                                data-toggle="modal" 
                                data-target="#deletaProspect"
                                data-prospect-id="<?=$prospect['id']?>">
                                Deletar
                            </button>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../modal/prospect/insere-medcontabil.php'; ?>
<?php include __DIR__ . '/../modal/prospect/edita.php'; ?>
<?php include __DIR__ . '/../modal/prospect/deleta.php'; ?>

<?php
require_once('rodape.php');
require_once('../template-medcontabil/rodape.php');
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
    });
    $('#cnpj').mask('00.000.000/0000-00');
    $('#telefone').mask('(00) 0000-0000');
    $('#celular').mask('(00) 00000-0000');
    $('#prospectCelular').mask('(00) 00000-0000');
    $('#prospectTelefone').mask('(00) 0000-0000');
    $('#prospectCnpj').mask('00.000.000/0000-00');
    $('#input-ano-formacao').mask('00/0000');
</script>

<script>
    $('#editaProspect').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('prospect-id') // Extract info from data-* attributes
        var nome = button.data('prospect-nome') // Extract info from data-* attributes
        var email = button.data('prospect-email') // Extract info from data-* attributes
        var contato = button.data('prospect-contato') // Extract info from data-* attributes
        var celular = button.data('prospect-celular') // Extract info from data-* attributes
        var telefone = button.data('prospect-telefone'); // Extract info from data-* attributes
        var nomeEmpresa = button.data('prospect-nome-empresa'); // Extract info from data-* attributes
        var cnpj = button.data('prospect-cnpj'); // Extract info from data-* attributes
        var profissao = button.data('prospect-profissao'); // Extract info from data-* attributes
        var especialidade = button.data('prospect-especialidade'); // Extract info from data-* attributes
        // var valor = button.data('cidade-ies') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        //modal.find('.modal-title').text('New message to ')
        modal.find('#prospectId').val(id);
        modal.find('#prospectNome').val(nome);
        modal.find('#prospectEmail').val(email);
        modal.find('#prospectContato').val(contato);
        modal.find('#prospectCelular').val(celular);
        modal.find('#prospectTelefone').val(telefone);
        modal.find('#prospectNomeEmpresa').val(nomeEmpresa);
        modal.find('#prospectCnpj').val(cnpj);
        modal.find('#propectProfissao').val(profissao);
        modal.find('#propectEspecialidade').val(especialidade);
        // modal.find('#altera-cidade-ies').val(valor)
        
        $('#prospectCelular').mask('(00) 00000-0000');
    });

    $('#deletaProspect').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('prospect-id'); // Extract info from data-* attributes
        var modal = $(this);

        modal.find('#prospectId').val(id);        
    });
</script>

<script>
    $("#inputProfissao").on("change", isFormando);

    function isFormando(profissao){
        if ($("#inputProfissao").val() == 'FORMANDO') {
            // console.log('ENTROU');
            $('#linha-ano-formacao').removeAttr("hidden");
            $('#input-ano-formacao').attr("required", "true");

            return;
        }

        $('#linha-ano-formacao').attr("hidden", "true");
        $('#input-ano-formacao').removeAttr("required");
        $('#input-ano-formacao').val('');        
    }
</script>