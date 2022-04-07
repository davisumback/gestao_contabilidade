<?php

use App\DAO\ApiDAO;
use App\Helper\Mensagem;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Verificar API's");
require_once('menu-left.php');
require_once('../cabecalho.php');

$apiDao = new ApiDAO();
$apis = $apiDao->getTodasApis();
?>

<div class="container-fluid">
    <?=Mensagem::getMensagem($_COOKIE, 'resultado_insercao_empresa', 'mensagem_insercao');?>

    <div class="card">
        <div class="card-header bg-success text-white text-center font-weight-bold">
            Área para ativar/desativar as API's do sistema
        </div>
        <div class="card-body">
            <div class="responsive-table">
                <table class="table table-borderless">
                    <thead class="label-cadastro">
                        <tr class="">
                            <th scope="col">API</th>
                            <th scope="col">Requisições restantes</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($apis as $api) : ?>
                            <tr class="text-secondary font-weight-bold">
                                <td><?=strtoupper($api['nome'])?></td>
                                <td><?=$api['requisicoes_restantes']?></td>
                                <td>
                                    <?php
                                        $classBtn = 'btn btn-success btn-sm btn-padrao font-weight-bold';
                                        $textoBtn = 'Produção';                                
                                        $status = 0;
                                        
                                        if ($api['ativo'] == 0) {
                                            $classBtn = 'btn btn-warning btn-sm btn-padrao font-weight-bold';
                                            $textoBtn = 'Em Teste';
                                            $status = 1;
                                        };
                                    ?>
                                    <form class="needs-validation-loading" action="../controllers/api/ativa-desativa.php" method="post" style="margin-bottom:0;">
                                        <input name="id" value="<?=$api['id']?>" hidden>
                                        <input name="status" value="<?=$status?>" hidden>
                                        <button type="submit" class="<?=$classBtn?>"><?=$textoBtn?></button>
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
