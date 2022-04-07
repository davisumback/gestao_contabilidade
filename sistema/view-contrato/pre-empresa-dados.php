<?php
use App\Helper\Helpers;
use App\Helper\EstadoCivil;
use App\Helper\Mensagem;
use App\DAO\EmpresasPlanosDAO;

require_once('header.php');
require_once('menu-topo.php');

if(!array_key_exists('PreEmpresaId', $_SESSION)){
    header("Location: pre-empresa-all.php");
    die();
}

$menu_topo->setTituloNavegacao('Pré-Empresa' . ' | ' . $_SESSION['PreEmpresaId']);
require_once('menu-left.php');
require_once('../cabecalho.php');

$dadosEmpresa = json_decode($_SESSION['PreEmpresainfo'], true);


$dao = new EmpresasPlanosDAO();
$planos = $dao->getPlanosPreEmpresas($_SESSION['PreEmpresaId']);

?>

<div class="container-fluid pb-5">
    <div class="row">
        <div class="col-12 label-cadastro text-center">
            <h4>
                <?php
                    $saida = $dadosEmpresa[0]['nome_1'] . ' | ' . $dadosEmpresa[0]['nome_2'] . ' | ' . $dadosEmpresa[0]['nome_3'];

                    if ($dadosEmpresa[0]['empresa_outro_escritorio'] == 1) {
                        $saida = Helpers::mask($dadosEmpresa[0]['cnpj'], '##.###.###/####-##');
                    }
                                        
                    echo $saida;
                ?>
            </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-10 mx-auto">
            <div class="linha"></div>
        </div>
    </div>

    <div class="row label-cadastro mt-4">
        <div class="col-4">
            <h6>Tipo Societário</h6>
            <h5><?=$dadosEmpresa[0]['tipo_societario']?></h5>
        </div>
    </div>

    <div class="row label-cadastro mt-4">
        <div class="col-4">
            <h6>Primeira Mensalidade</h6>
            <h5><?=Helpers::formataDataView($dadosEmpresa[0]['primeira_mensalidade'])?></h5>
        </div>

        <div class="col-4">
            <h6>Total Honorários</h6>
            <h5>R$
                <?php
                    $valorSaida = 0;
                    foreach($planos as $valor) :
                        $valorSaida += $valor['valor'];
                    endforeach
                ?>
                <?=Helpers::formataMoedaView($valorSaida)?>
            </h5>
        </div>
    </div>

    <div class="row label-cadastro mt-4">
        <div class="col-4">
            <h6>Vendedor</h6>
            <h5><?=$dadosEmpresa[0]['usuario_nome']?></h5>
        </div>

        <div class="col-4">
            <h6>Data do Cadastro</h6>
            <h5><?=Helpers::formataDataView($dadosEmpresa[0]['data_cadastro'])?></h5>
        </div>
    </div>

    <div class="row">
        <div class="col-10 mx-auto">
            <hr>
        </div>
    </div>

    <div class="row label-cadastro mt-5">
        <div class="col-12 text-center">
            <h5>Planos</h5>
        </div>
    </div>

    <?php foreach ($planos as $plano) : ?>
        <div class="row label-cadastro mt-4">
            <div class="col-4">
                <h6>Plano</h6>
                <h5><?=$plano['nome']?></h5>
            </div>

            <div class="col-4">
                <h6>Valor</h6>
                <h5>R$ <?=Helpers::formataMoedaView($plano['valor'])?></h5>
            </div>
        </div>
    <?php endforeach ?>

    <div class="row">
        <div class="col-12 mx-auto">
            <div class="linha"></div>
        </div>
    </div>

    <div class="row label-cadastro mt-5">
        <div class="col-12 text-center">
            <h5>Sócio(s)</h5>
        </div>
    </div>

    <?php foreach ($dadosEmpresa as $arraychaves => $arrayDados) : ?>
        <div class="row label-cadastro mt-4">
            <div class="col-md-4 col-sm-12">
                <h6>Sócio <?=(sizeof($dadosEmpresa) == 1) ? '' : $arraychaves+1?></h6>
                <h5><?=$arrayDados['nome_completo']?></h5>
            </div>
            <div class="col-md-4 col-sm-12">
                <h6>Porcentagem Societária</h6>
                <h5><?=number_format($arrayDados['porcentagem_societaria'],0)?>%</h5>
            </div>
            <div class="col-md-4 col-sm-12">
                <h6>Sócio Administrador</h6>
                <h5><?=($arrayDados['socio_administrador'] == 1) ? 'Sim' : 'Não'?></h5>
            </div>
        </div>

        <div class="row label-cadastro mt-4">
            <div class="col-4">
                <h6>CPF</h6>
                <h5><?=Helpers::mask($arrayDados['cpf'], '###.###.###-##')?></h5>
            </div>

            <div class="col-4">
                <h6>Email</h6>
                <h5><?=$arrayDados['email']?></h5>
            </div>

            <div class="col-4">
                <h6>CRM</h6>
                <h5><?=$arrayDados['crm']?></h5>
            </div>
        </div>

        <div class="row label-cadastro mt-4">
            <div class="col-4">
                <h6>Data de Nascimento</h6>
                <h5><?=Helpers::formataDataView($arrayDados['data_nascimento'])?></h5>
            </div>

            <div class="col-4">
                <h6>Telefone Celular</h6>
                <h5><?=Helpers::mask($arrayDados['telefone_celular'],'(##) #####-####')?></h5>
            </div>

            <div class="col-4">
                <h6>Telefone Comercial</h6>
                <h5>
                    <?php
                        ($arrayDados['telefone_comercial'] == '')? '' : Helpers::mask($arrayDados['telefone_comercial'], '(##) ####-####');
                    ?>
                </h5>
            </div>
        </div>

        <div class="row label-cadastro mt-4">
            <div class="col-4">
                <h6>Estado Civil</h6>
                <h5><?=EstadoCivil::formataEstadoCivil($arrayDados['estado_civil'])?></h5>
            </div>

            <div class="col-4">
                <h6>Regime de Casamento</h6>
                <h5><?=EstadoCivil::formataRegimeCasamento($arrayDados['regime_casamento'])?></h5>
            </div>

            <div class="col-4">
                <h6>Profissão</h6>
                <h5><?=$arrayDados['profissao']?></h5>
            </div>
        </div>

        <div class="row label-cadastro mt-4">
            <div class="col-4">
                <h6>Documento Cadastrado</h6>
                <h5><?=$arrayDados['tipo_documento']?></h5>
            </div>

            <div class="col-4">
                <h6>Número do Documento</h6>
                <h5><?=$arrayDados['documento_numero']?></h5>
            </div>

            <div class="col-4">
                <h6>Data de Emissão</h6>
                <h5><?=($arrayDados['data_emissao'] == null) ? '' : Helpers::formataDataView($arrayDados['data_emissao'])?></h5>
            </div>
        </div>

        <div class="row label-cadastro mt-4">
            <div class="col-4">
                <h6>Órgão Expedidor</h6>
                <h5><?=$arrayDados['orgao_expedidor']?></h5>
            </div>

            <div class="col-4">
                <h6>Validade</h6>
                <h5><?=($arrayDados['validade'] == null) ? '' : Helpers::formataDataView($arrayDados['validade'])?></h5>
            </div>

            <div class="col-4">
                <h6>UF</h6>
                <h5><?=($arrayDados['documento_uf'] == 0)? '' : $arrayDados['documento_uf']?></h5>
            </div>
        </div>

        <div class="row label-cadastro mt-4 mb-5 pb-5">
            <div class="col-4">
                <h6>IES</h6>
                <h5><?=$arrayDados['naturalidade']?></h5>
            </div>
            <div class="col-4">
                <h6>IES</h6>
                <h5><?=$arrayDados['ies_nome']?></h5>
            </div>

            <div class="col-4">
                <h6>Cidade IES</h6>
                <h5><?=$arrayDados['ies_cidade']?></h5>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    $('#data-competencia').mask('00/0000');
</script>
