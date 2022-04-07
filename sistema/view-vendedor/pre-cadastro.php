<?php
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Pré Cadastros Pendentes");
require_once('menu-left.php');
require_once('../cabecalho.php');

$usuariosId = $_SESSION['id_usuario'];

?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="text-center">
                <button TYBE="button" onclick="vaiParaNovaPagina('cadastro-empresa.php')" class="btn btn-padrao btn-success mb-4 font-weight-bold">Novo Pré Cadastro</button>
            </div>

            <div class="table-responsive mb-5">
                <table id="myTable" class="table table-hover">
                    <thead class="label-cadastro">
                        <tr class="table-success">
                            <th class="text-nowrap" scope="col">Nome Empresa</th>
                            <th scope="col">Contato</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telefone</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    <tbody class="label-cadastro">
                        <tr style="cursor:pointer;">
                            <td class="text-nowrap" onclick="vaiParaNovaPagina('cadastro-empresa.php')">Lorem ipsum dolor</td>
                            <td onclick="vaiParaNovaPagina('cadastro-empresa.php')">Lorem</td>
                            <td onclick="vaiParaNovaPagina('cadastro-empresa.php')">exemplo@exemplo.com.br</td>
                            <td onclick="vaiParaNovaPagina('cadastro-empresa.php')">(44) 9 9999-9999</td>
                            <td class="text-nowrap" style="cursor:auto">
                                <button type="button" class="btn btn-padrao btn-success btn-sm font-weight-bold" data-toggle="modal" data-target="#enviaCartaPreCadastro">
                                    Carta
                                </button>
                                <button type="button" class="btn btn-padrao btn-warning btn-sm font-weight-bold" data-toggle="modal" data-target="#editaPreCadastro">
                                    Editar
                                </button>
                                <button type="button" class="btn btn-primary btn-padrao btn-danger btn-sm font-weight-bold" data-toggle="modal" data-target="#deletaProspect">
                                    Deletar
                                </button>
                            </td>
                        </tr>
                        <tr style="cursor:pointer;" onclick="vaiParaNovaPagina('cadastro-empresa.php')">
                            <td class="text-nowrap" onclick="vaiParaNovaPagina('cadastro-empresa.php')">Lorem ipsum dolor</td>
                            <td onclick="vaiParaNovaPagina('cadastro-empresa.php')">Lorem</td>
                            <td onclick="vaiParaNovaPagina('cadastro-empresa.php')">exemplo@exemplo.com.br</td>
                            <td onclick="vaiParaNovaPagina('cadastro-empresa.php')">(44) 9 9999-9999</td>
                            <td class="text-nowrap" style="cursor:auto">
                                <button type="button" class="btn btn-padrao btn-success btn-sm font-weight-bold" data-toggle="modal" data-target="#enviaCartaPreCadastro">
                                    Carta
                                </button>
                                <button type="button" class="btn btn-padrao btn-warning btn-sm font-weight-bold" data-toggle="modal" data-target="#editaPreCadastro">
                                    Editar
                                </button>
                                <button type="button" class="btn btn-primary btn-padrao btn-danger btn-sm font-weight-bold" data-toggle="modal" data-target="#deletaProspect">
                                    Deletar
                                </button>
                            </td>
                        </tr>
                        <tr style="cursor:pointer;" onclick="vaiParaNovaPagina('cadastro-empresa.php')">
                            <td class="text-nowrap" onclick="vaiParaNovaPagina('cadastro-empresa.php')">Lorem ipsum dolor</td>
                            <td onclick="vaiParaNovaPagina('cadastro-empresa.php')">Lorem</td>
                            <td onclick="vaiParaNovaPagina('cadastro-empresa.php')">exemplo@exemplo.com.br</td>
                            <td onclick="vaiParaNovaPagina('cadastro-empresa.php')">(44) 9 9999-9999</td>
                            <td class="text-nowrap" style="cursor:auto">
                                <button type="button" class="btn btn-padrao btn-success btn-sm font-weight-bold" data-toggle="modal" data-target="#enviaCartaPreCadastro">
                                    Carta
                                </button>
                                <button type="button" class="btn btn-padrao btn-warning btn-sm font-weight-bold" data-toggle="modal" data-target="#editaPreCadastro">
                                    Editar
                                </button>
                                <button type="button" class="btn btn-primary btn-padrao btn-danger btn-sm font-weight-bold" data-toggle="modal" data-target="#deletaProspect">
                                    Deletar
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../modal/comercial/enviar-carta-pre-cadastro.php'; ?>
<?php include __DIR__ . '/../modal/comercial/editar-pre-cadastro.php'; ?>
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
    });
    // $('#cnpj').mask('00.000.000/0000-00');
    // $('#telefone').mask('(00) 0000-0000');
    // $('#celular').mask('(00) 00000-0000');
    // $('#prospectCelular').mask('(00) 00000-0000');
    // $('#prospectTelefone').mask('(00) 0000-0000');
    // $('#prospectCnpj').mask('00.000.000/0000-00');
    // $('#input-ano-formacao').mask('00/0000');
</script>

<script>
    // $('#editaProspect').on('show.bs.modal', function (event) {
    //     var button = $(event.relatedTarget); // Button that triggered the modal
    //     var id = button.data('prospect-id'); // Extract info from data-* attributes
    //     var nome = button.data('prospect-nome'); // Extract info from data-* attributes
    //     var email = button.data('prospect-email'); // Extract info from data-* attributes
    //     var contato = button.data('prospect-contato'); // Extract info from data-* attributes
    //     var celular = button.data('prospect-celular'); // Extract info from data-* attributes
    //     var telefone = button.data('prospect-telefone'); // Extract info from data-* attributes
    //     var nomeEmpresa = button.data('prospect-nome-empresa'); // Extract info from data-* attributes
    //     var cnpj = button.data('prospect-cnpj'); // Extract info from data-* attributes
    //     var profissao = button.data('prospect-profissao'); // Extract info from data-* attributes
    //     var especialidade = button.data('prospect-especialidade'); // Extract info from data-* attributes
    //     // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    //     // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    //     var modal = $(this);
    //     //modal.find('.modal-title').text('New message to ')
    //     modal.find('#prospectId').val(id);
    //     modal.find('#prospectNome').val(nome);
    //     modal.find('#prospectEmail').val(email);
    //     modal.find('#prospectContato').val(contato);
    //     modal.find('#prospectCelular').val(celular);
    //     modal.find('#prospectTelefone').val(telefone);
    //     modal.find('#prospectNomeEmpresa').val(nomeEmpresa);
    //     modal.find('#prospectCnpj').val(cnpj);
    //     modal.find('#propectProfissao').val(profissao);
    //     modal.find('#propectEspecialidade').val(especialidade);

    // });    

    // $('#deletaProspect').on('show.bs.modal', function (event) {
    //     var button = $(event.relatedTarget); // Button that triggered the modal
    //     var id = button.data('prospect-id'); // Extract info from data-* attributes
    //     var nome = button.data('prospect-nome'); // Extract info from data-* attributes
    //     var email = button.data('prospect-email'); // Extract info from data-* attributes
    //     var contato = button.data('prospect-contato'); // Extract info from data-* attributes
    //     var celular = button.data('prospect-celular'); // Extract info from data-* attributes
    //     var telefone = button.data('prospect-telefone'); // Extract info from data-* attributes
    //     var nomeEmpresa = button.data('prospect-nome-empresa'); // Extract info from data-* attributes
    //     var cnpj = button.data('prospect-cnpj'); // Extract info from data-* attributes
    //     var profissao = button.data('prospect-profissao'); // Extract info from data-* attributes
    //     var especialidade = button.data('prospect-especialidade'); // Extract info from data-* attributes
    //     var modal = $(this);

    //     modal.find('#prospectId').val(id);
    // });
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

