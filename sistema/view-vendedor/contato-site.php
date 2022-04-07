<?php
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Cadastro de Prospects");
require_once('menu-left.php');
require_once('../cabecalho.php');

$usuariosId = $_SESSION['id_usuario'];

$dao = new \App\DAO\ContatoSiteDAO();

if ($_GET['contatos'] == 'atendidos') {
    $caminhoUrl = 'contato-site.php?contatos=naoAtendidos';
    $classButton = 'btn-warning';
    $textoButton = 'Ver não atendidos';
    $contatos = $dao->getContatosSite($usuariosId, 'MEDCONTABIL', 'SIM');
} else {
    $caminhoUrl = 'contato-site.php?contatos=atendidos';
    $classButton = 'btn-success';
    $textoButton = 'Ver atendidos';
    $contatos = $dao->getContatosSite($usuariosId, 'MEDCONTABIL', 'NAO');
}
?>

<div class="container-fluid">
    <div class="alert alert-light text-center pt-4 pb-4" role="alert">
        <strong class="label-cadastro">Todos os Contatos vindos do site <span class="text-primary">Medcontábil</span> :)</strong>
    </div>

    <div class="container">
        <?=\App\Helper\Mensagem::getMensagem($_COOKIE, 'resultadoContato', 'mensagemContato')?>
    </div>

    <div class="text-center mb-4">
        <a class="btn btn-padrao <?=$classButton?>" href="<?=$caminhoUrl?>"><?=$textoButton?></a>
    </div>

    <div class="table-responsive mb-5">
        <?php if ($_GET['contatos'] == 'naoAtendidos') : ?>
            <table id="myTable" class="table table-bordered table-hover">
                <thead class="label-cadastro">                   
                    <tr class="table-success">
                        <th scope="col">Contato</th>
                        <th scope="col">Criado</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody class="label-cadastro">
                    <?php foreach ($contatos as $contato) : ?>
                        <tr>
                            <td>
                                <?php
                                    $telefone = $contato['telefone_ddd'] . $contato['telefone_numero'];
                                    echo Helpers::mask($telefone, '(##) ##### - ####');
                                ?>
                            </td>
                            <td><?=Helpers::formataDataCompletaView($contato['created_at'])?></td>
                            <td>
                                <?php if ($contato['atendido'] == 'NAO') : ?>
                                    <form action="../controllers/lead/atende-contato.php" method="post" class="needs-validation-loading" style="margin-bottom:0px;">
                                        <input name="contatosId" value="<?=$contato['id']?>" hidden>
                                        <button type="submit" class="btn btn-sm btn-padrao btn-success">Atendido</button>
                                    </form>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php else : ?>
            <table id="myTable" class="table table-bordered table-hover">
                <thead class="label-cadastro">                   
                    <tr class="table-success">
                        <th scope="col">Contato</th>
                        <th scope="col">Atendido</th>
                    </tr>
                </thead>

                <tbody class="label-cadastro">
                    <?php foreach ($contatos as $contato) : ?>
                        <tr>
                            <td>
                                <?php
                                    $telefone = $contato['telefone_ddd'] . $contato['telefone_numero'];
                                    echo Helpers::mask($telefone, '(##) ##### - ####');
                                ?>
                            </td>
                            <td><?=Helpers::formataDataCompletaView($contato['updated_at'])?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php endif ?>        
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
                lengthMenu:     "Mostrar _MENU_ Contatos",
                infoPostFix:    "",
                info:           "Mostrando _START_ de _END_ do total de _TOTAL_ contatos",
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