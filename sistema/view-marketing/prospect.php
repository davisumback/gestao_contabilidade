<?php
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Cadastro de Prospects");
require_once('menu-left.php');
require_once('../cabecalho.php');

$usuariosId = $_SESSION['id_usuario'];

$dao = new \App\Model\Prospect\Prospect();
$prospects = $dao->allProspects();
?>

<div class="container-fluid">
    <div class="container">
        <?=\App\Helper\Mensagem::getMensagem($_COOKIE, 'resultadoDadosProspect', 'mensagemDadosProspect')?>
    </div>
    <div class="card">
        <div class="card-header bg-success text-white text-center font-weight-bold">
            Todos os Prospects :)
        </div>
        <div class="card-body">
            <div class="table-responsive mb-5">
                <table id="myTable" class="table table-hover">
                    <thead class="table-success">                   
                        <tr class="label-cadastro">
                            <th scope="col">Doutor</th>
                            <th scope="col">Contato</th>
                            <th scope="col">Email</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Sexo</th>
                        </tr>
                    </thead>

                    <tbody class="label-cadastro">
                        <?php foreach ($prospects as $prospect) : ?>
                            <tr style="cursor:pointer;">
                                <td onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['nome_doutor']?></td>
                                <td onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['nome_contato']?></td>
                                <td onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=$prospect['email']?></td>
                                <td class="text-nowrap" onclick="vaiParaNovaPagina('proposta-comercial.php?prospect=<?=$prospect['id']?>')"><?=Helpers::mask($prospect['celular'], '(##) #####-####')?></td>
                                <td class="text-nowrap" style="cursor:auto">
                                    <form class="needs-validation-loading mb-0 d-inline-block" action="../controllers/grupob/prospect.php" method="post">
                                        <input name="method" value="updateSexo" hidden>
                                        <input name="sexo" value="M" hidden>
                                        <input name="prospectId" value="<?=$prospect['id']?>" hidden>
                                        <input name="usuariosId" value="<?=$prospect['usuariosId']?>" hidden>
                                        <button class="btn btn-padrao btn-sm btn-cor-primaria font-weight-bold" type="submit">M</button>
                                    </form>

                                    <form class="needs-validation-loading mb-0 d-inline-block" action="../controllers/grupob/prospect.php" method="post">
                                        <input name="method" value="updateSexo" hidden>
                                        <input name="sexo" value="F" hidden>
                                        <input name="prospectId" value="<?=$prospect['id']?>" hidden>
                                        <input name="usuariosId" value="<?=$prospect['usuariosId']?>" hidden>
                                        <button class="btn btn-padrao btn-sm btn-cor-primaria font-weight-bold" type="submit">F</button>
                                    </form>          
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>            
        </div>
    </div>
</div>

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