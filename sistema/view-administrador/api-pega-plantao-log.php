<?php
use App\DAO\PegaPlantaoLogDAO;
use App\DAO\PegaPlantaoParceiroDAO;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao('Log de erros da integração Pega Plantão');
require_once('menu-left.php');
require_once('../cabecalho.php');

$logs = PegaPlantaoLogDAO::all();
$parceiros = PegaPlantaoParceiroDAO::all();
?>

<div class="container-fluid">
    <div class="alert alert-light text-center pt-4 pb-4 label-cadastro" role="alert">        
        Executar rotina manualmente
    </div>
    <div class="mb-3 text-center alert alert-dismissible fade show alert-login" role="alert" id="feedback">
        <strong id="msg"></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="row">
        <form>
            <div class="col-md-4 label-cadastro">
                <label for="">Parceiro</label>
                <select name="parceiro" class="custom-select d-block w-100" id="parceiro" required>
                    <option value="">Escolha...   </option>
                    <?php foreach($parceiros as $p){ ?>
                        <option value="<?=$p->getId()?>"><?=$p->getNome()?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3 label-cadastro">
                <label for="">Início</label>
                <input name="start_date" type="text" class="form-control" id="start_date" required>
                <div class="invalid-feedback" id="inicio">
                    Digite uma data válida.
                </div>
            </div>
            <div class="col-md-3 label-cadastro">
                <label for="">Fim</label>
                <input name="end_date" type="text" class="form-control" id="end_date" required>
                <div class="invalid-feedback" id="fim">
                    Digite uma data válida.
                </div>
            </div>
            <div class="col-md-2 label-cadastro" style='margin-top:30px'>
                <button type="submit" id="executar" class="btn btn-cadastrar">Executar</button>   
            </div>
        </form>                  
    </div>
    <div class="row mt-5">
        <div class="table-responsive mb-5">
            <table id="myTable" class="table table-bordered table-hover">
                <thead class="label-cadastro">                   
                    <tr class="table-success">
                        <th scope="col">Parceiro</th>
                        <th scope="col">Erro Descrição</th>
                        <th scope="col">Erro Data</th>
                    </tr>
                </thead>
                <tbody class="label-cadastro">
                    <?php foreach ($logs as $log) : ?>
                        <tr>
                            <td class="text-nowrap"><?=$log->getParceiro()->getNome()?></td>
                            <td class="text-nowrap"><?=$log->getDescricao()?></td>
                            <td class="text-nowrap"><?=Helpers::formataDataCompletaView($log->getCreatedAt())?></td>     
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    $(document).ready( function () {
        $('#start_date').mask('00/00/0000');
        $('#end_date').mask('00/00/0000');
        $('#inicio').hide();
        $('#fim').hide();
        $('#feedback').hide();       

        $('#myTable').DataTable( {
            language: {
                search:         "Pesquisar",
                lengthMenu:     "Mostrar _MENU_ Erros",
                infoPostFix:    "",
                info:           "Mostrando _START_ de _END_ do total de _TOTAL_ logs",
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
        
        $('form').on('submit',function(e) {
            e.preventDefault();
            $('#feedback').hide();
            var valido = true;
            var parceiro = $('#parceiro').val();

            var inicio = $('#start_date').val();
            inicio = `${inicio.substring(6)}-${inicio.substring(3,5)}-${inicio.substring(0,2)}`;

            if(inicio.length < 10){
                $('#inicio').show();
                valido = false;
            }

            var fim = $('#end_date').val();
            fim = `${fim.substring(6)}-${fim.substring(3,5)}-${fim.substring(0,2)}`;

            if(fim.length < 10){
                $('#fim').show();
                valido = false;
            }
            if(!valido){
                return;
            }
            mostraGifLoading();
            fetch(`../../script/pega-plantao/api-pega-plantao.php?start_date=${inicio}&end_date=${fim}&parceiro=${parceiro}`,{
                method : "GET"
            }).then(
                response => response.text()
                
            ).then(
                msg => {
                    if(msg == 'sucesso'){
                        $('#msg').html('Rotina Processada com sucesso!');
                        $('#feedback').show();
                        $('#feedback').addClass('alert-success');
                        $('#feedback').removeClass('alert-danger');
                    }else{
                        $('#msg').html(msg);
                        $('#feedback').show();
                        $('#feedback').addClass('alert-danger');
                        $('#feedback').removeClass('alert-success');
                    }
                    
                    console.log(msg);
                    mostraGifLoading(); 
                    $('#conteudo').removeClass('cor-fundo'); 
                }
            );
        });
    });
</script>
