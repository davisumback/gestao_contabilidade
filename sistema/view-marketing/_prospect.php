<?php
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Cadastro de Prospects");
require_once('menu-left.php');
require_once('../cabecalho.php');

$usuariosId = $_SESSION['id_usuario'];

$dao = new \App\DAO\ProspectDAO();
$prospects = $dao->allPorUsuario($usuariosId);
?>

<div class="container-fluid">
    <div class="alert alert-light text-center pt-4 pb-4" role="alert">
        <strong class="label-cadastro">Todos os Prospects :)</strong>
    </div>

    <div class="text-center">
        <button data-toggle="modal" data-target="#novo-prospect" class="btn btn-padrao btn-success mb-4">Novo Prospect</button>
    </div>

    <?=\App\Helper\Mensagem::getMensagem($_COOKIE, 'resultadoDadosProspect', 'mensagemDadosProspect')?>

    <div class="table-responsive mb-5">
        <table id="myTable" class="table table-bordered table-hover">
            <thead class="label-cadastro">                   
                <tr class="table-success">
                    <th scope="col">Doutor</th>
                    <th scope="col">Contato</th>
                    <th scope="col">Email</th>
                    <th scope="col">Celular</th>
                </tr>
            </thead>

            <tbody class="label-cadastro">
                <?php foreach ($prospects as $prospect) : ?>
                    <tr style="cursor:pointer;" onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')">
                        <td><?=$prospect['nome_doutor']?></td>
                        <td><?=$prospect['nome_contato']?></td>
                        <td><?=$prospect['email']?></td>
                        <td><?=($prospect['celular'] != '') ? Helpers::mask($prospect['celular'], '(##) #####-####') : ''?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../modal/prospect/insere.php'; ?>

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