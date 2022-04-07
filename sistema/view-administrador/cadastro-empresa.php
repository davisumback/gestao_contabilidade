<?php
use App\Helper\Mensagem;
use App\Helper\Helpers;
use App\Helper\NaturezaJuridica;
use App\DAO\ClienteEmpresaDAO;
use App\DAO\EnderecoEmpresaDAO;
use App\DAO\PlanoDAO;
use App\DAO\UsuarioDAO;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Cadastro Empresa");
require_once('menu-left.php');
require_once('../cabecalho.php');

$pasta = 'view-cadastro';

$planoDAO = new PlanoDAO();
$planoArray = $planoDAO->getTodosPlanos();

$usuarioDAO = new UsuarioDAO();
$gestores = $usuarioDAO->getPerfilUsuario(6);
$contadores = $usuarioDAO->getPerfilUsuario(4);
?>

<div class="container-fluid pb-1" id="conteudo">
    <div class="text-center mt-1">
        <?=Mensagem::getMensagem($_COOKIE, 'resultado_insercao_empresa', 'mensagem_insercao');?>
    </div>
</div>

<div class="container-fluid">
    <div class="content" id="">
        <div class="row justify-content-around mb-5">
            <div class="col-md-12">
                <div class="card mb-5">
                    <div class="card-header bg-cor-accent-primaria text-center">
                        <i class="fa fa-user"></i><strong class="card-title pl-md-2">Cadastro de Empresa</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h5 class="label-cadastro">Nome</h5>
                                <input type="email" class="form-control font-weight-bold mt-1" id="exampleInputEmail1" aria-describedby="emailHelp" value="Lorem ipsum dolor sit">
                            </div>
                            <div class="col-md-3">
                                <h5 class="label-cadastro">E-mail</h5>
                                <input type="email" class="form-control font-weight-bold mt-1" id="exampleInputEmail1" aria-describedby="emailHelp" value="exemplo@exemplo.com.br">
                            </div>
                            <div class="col-md-3">
                                <h5 class="label-cadastro">Telefone</h5>
                                <input type="email" class="form-control font-weight-bold mt-1" id="exampleInputEmail1" aria-describedby="emailHelp" value="44 99999-9999">
                            </div>                            
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <h5 class="label-cadastro">Sexo</h5>
                                <select name="uf_endereco" class="custom-select font-weight-bold d-block w-100 mt-1" id="estado" required>
                                    <option value="" id="escolha">Escolha...</option>
                                    <option value="MASCULINO" id="masculino" selected>Masculino</option>
                                    <option value="FEMININO" id="feminino">Feminio</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <h5 class="label-cadastro">Profissão</h5>
                                <select name="uf_endereco" class="custom-select font-weight-bold d-block w-100 mt-1" id="estado" required>
                                    <option value="" id="escolha">Escolha...</option>
                                    <option value="medico" id="medico" selected>Médico</option>
                                    <option value="outros" id="profissao-outros">Outros</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <h5 class="label-cadastro">Especialidade</h5>
                                <select name="uf_endereco" class="custom-select font-weight-bold d-block w-100 mt-1" id="estado" required>
                                    <option value="" id="escolha">Escolha...</option>
                                    <option value="" id="">Opção 1</option>
                                    <option value="" id="">Opção 2</option>
                                    <option value="" id="">Opção 3</option>
                                    <option value="" id="">Opção 4</option>
                                    <option value="" id="">Opção 5</option>
                                </select>
                            </div>                            
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-2">
                                <h5 class="label-cadastro">CEP</h5>
                                <input type="email" class="form-control font-weight-bold mt-1" id="exampleInputEmail1" aria-describedby="emailHelp" value="87030-008">
                            </div> 
                            <div class="col-md-3">
                                <h5 class="label-cadastro">Endereço</h5>
                                <input type="email" class="form-control font-weight-bold mt-1" id="exampleInputEmail1" aria-describedby="emailHelp" value="Av. Pedro Taques">
                            </div>
                            <div class="col-md-1">
                                <h5 class="label-cadastro">Nº</h5>
                                <input type="email" class="form-control text-center font-weight-bold mt-1" id="exampleInputEmail1" aria-describedby="emailHelp" value="294">
                            </div>
                            <div class="col-6 mb-2 label-cadastro text-center">
                                <h5 class="label-cadastro mb-1">Clínica Física</h5>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="sim-clinica-fisica" name="clinica-fisica" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="sim-clinica-fisica">Sim</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="nao-clinica-fisica" name="clinica-fisica" class="custom-control-input">
                                    <label class="custom-control-label" for="nao-clinica-fisica">Não</label>
                                </div>
                            </div>                                                      
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-2">
                                <h5 class="label-cadastro">Cidade</h5>
                                <input type="email" class="form-control font-weight-bold mt-1" id="exampleInputEmail1" aria-describedby="emailHelp" value="Maringá">
                            </div>
                            <div class="col-md-2">
                                <h5 class="label-cadastro">Estado</h5>
                                <select name="uf_endereco" class="custom-select font-weight-bold d-block w-100 mt-1" id="estado" required>
                                    <option value="" id="escolha">Escolha...</option>
                                    <option value="AC" id="AC">Acre</option>
                                    <option value="AL" id="AL">Alagoas</option>
                                    <option value="AP" id="AP">Amapá</option>
                                    <option value="AM" id="AM">Amazonas</option>
                                    <option value="BA" id="BA">Bahia</option>
                                    <option value="CE" id="CE">Ceará</option>
                                    <option value="DF" id="DF">Distrito Federal</option>
                                    <option value="ES" id="ES">Espírito Santo</option>
                                    <option value="GO" id="GO">Goiás</option>
                                    <option value="MA" id="MA">Maranhão</option>
                                    <option value="MT" id="MT">Mato Grosso</option>
                                    <option value="MS" id="MS">Mato Grosso do Sul</option>
                                    <option value="MG" id="MG">Minas Gerais</option>
                                    <option value="PA" id="PA">Pará</option>
                                    <option value="PB" id="PB">Paraíba</option>
                                    <option value="PR" id="PR" selected>Paraná</option>
                                    <option value="PE" id="PE">Pernambuco</option>
                                    <option value="PI" id="PI">Piauí</option>
                                    <option value="RJ" id="RJ">Rio de Janeiro</option>
                                    <option value="RN" id="RN">Rio Grande do Norte</option>
                                    <option value="RS" id="RS">Rio Grande do Sul</option>
                                    <option value="RO" id="RO">Rondônia</option>
                                    <option value="RR" id="RR">Roraima</option>
                                    <option value="SC" id="SC">Santa Catarina</option>
                                    <option value="SP" id="SP">São Paulo</option>
                                    <option value="SE" id="SE">Sergipe</option>
                                    <option value="TO" id="TO">Tocantins</option>
                                </select>
                            </div>                         
                        </div>
                        <div class="row mt-3">
                            <div class="col text-right">
                                <button type="button" class="btn btn-success btn-padrao font-weight-bold btn-lg" data-toggle="collapse" data-target="#collapseFinanceiro" aria-expanded="false" aria-controls="collapseFinanceiro">
                                    Salvar
                                </button>  
                            </div>
                        </div>
                        <hr>

<!-- ********************************** COLLAPSE FINANCEIRO *********************************************** -->

                        <div class="collapse" id="collapseFinanceiro">
                            <div class="row">
                                <div class="col-5">
                                    <div class="card">
                                        <div class="card-header bg-cor-accent-primaria text-center font-weight-bold">
                                            Financeiro
                                        </div>
                                        <div class="card-body">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="label-cadastro border-top-0 h5" scope="col">Qtd</th>
                                                        <th class="label-cadastro border-top-0" scope="col"></th>
                                                        <th class="label-cadastro border-top-0 h5" scope="col">Valor</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="">
                                                        <td class="font-weight-bold p-1">
                                                            <input class="form-control col-4" type="text" value="10">
                                                        </td>
                                                        <td class="label-cadastro p-1">Sócios</td>
                                                        <td class="font-weight-bold p-1">R$40,00</td>
                                                    </tr>
                                                    <tr class="">
                                                        <td class="font-weight-bold p-1">
                                                            <input class="form-control col-4" type="text" value="10">
                                                        </td>
                                                        <td class="label-cadastro p-1">Funcionários</td>
                                                        <td class="font-weight-bold p-1">R$40,00</td>
                                                    </tr>
                                                    <tr class="">
                                                        <td class="font-weight-bold p-1">
                                                            <input class="form-control col-4" type="text" value="10">
                                                        </td>
                                                        <td class="label-cadastro p-1">Domésticas</td>
                                                        <td class="font-weight-bold p-1">R$70,00</td>
                                                    </tr>
                                                    <tr class="">
                                                        <td class="font-weight-bold p-1">
                                                            <input class="form-control col-4" type="text" value="SIM">
                                                        </td>
                                                        <td class="label-cadastro p-1">Gestor Administrativo</td>
                                                        <td class="font-weight-bold p-1">R$178,00</td>
                                                    </tr>
                                                    <tr class="">
                                                        <td class="font-weight-bold p-1">
                                                            <input class="form-control col-4" type="text" value="1">
                                                        </td>
                                                        <td class="label-cadastro p-1">Contabilidade</td>
                                                        <td class="font-weight-bold p-1">R$178,00</td>
                                                    </tr>
                                                    <tr class="">
                                                        <td class="p-1"></td>
                                                        <td class="label-cadastro p-1">Total</td>
                                                        <td class="font-weight-bold p-1">R$450,00</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col text-right">
                                    <button type="button" class="btn btn-lg btn-success btn-padrao font-weight-bold">
                                        Salvar
                                    </button>  
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-3">
                                <div class="col text-center">
                                    <h5 class="label-cadastro">Situação</h5>
                                </div>
                            </div>

                            <div class="accordion" id="accordionExample">
                                <div class="row mt-3 mb-5">
                                    <div class="col-md-6 text-right">
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold collapsed" data-toggle="collapse" data-target="#collapseAbertura" aria-expanded="false" aria-controls="collapseAbertura">
                                            Abertura
                                        </button>                                
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <button type="button" class="btn btn-info btn-padrao font-weight-bold collapsed" data-toggle="collapse" data-target="#collapseTransferencia" aria-expanded="false" aria-controls="collapseTransferencia">
                                            Transferência
                                        </button>                                
                                    </div>
                                </div>

    <!-- ********************************** COLLAPSE ABERTURA *********************************************** -->

                                <div class="collapse" id="collapseAbertura" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card border-info rounded">
                                        <div class="card-header bg-info text-white font-weight-bold text-center p-1">
                                            Dados do Administrador
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6 mb-2 label-cadastro text-center">
                                                    <h5 class="font-weight-bold">Tipo Societário</h5>
                                                </div>
                                                <div class="col-6 mb-2 label-cadastro text-center">
                                                    <h5 class="font-weight-bold">Tipo do Estabelecimento</h5>
                                                </div>
                                            </div>                                    
                                            <div class="row">
                                                <div class="col-6 mb-2 label-cadastro text-center">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="radio-ltda" name="tipo-societario" class="custom-control-input">
                                                        <label class="custom-control-label" for="radio-ltda">LTDA</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="radio-eireli" name="tipo-societario" class="custom-control-input">
                                                        <label class="custom-control-label" for="radio-eireli">EIRELI</label>
                                                    </div>
                                                </div>
                                                <div class="col-6 mb-2 label-cadastro text-center">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="customRadioInline3" name="customRadioInline2" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioInline3">Físico</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="customRadioInline4" name="customRadioInline2" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioInline4">Ponto de referência</label>
                                                    </div>
                                                </div>
                                            </div>                                
                                            <div class="row mt-4">
                                                <div class="col-md-4">
                                                    <label class="label-cadastro font-weight-bold h6" for="">Nome</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="label-cadastro font-weight-bold h6" for="">CPF</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="label-cadastro font-weight-bold h6" for="">RG</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>                
                                            <div class="row mt-2">
                                                <div class="col-md-3">
                                                    <label class="label-cadastro font-weight-bold h6" for="">Email</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="label-cadastro font-weight-bold h6" for="">Telefone</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="label-cadastro font-weight-bold h6" for="">Sexo</label>
                                                    <select name="uf_endereco" class="custom-select d-block w-100" id="estado" required>
                                                        <option value="" id="escolha">Escolha...</option>
                                                        <option value="MASCULINO" id="AC">Masculino</option>
                                                        <option value="FEMININO" id="AL">Feminio</option>
                                                    </select>
                                                </div>
                                            </div>                               
                                            <div class="row mt-2">
                                                <div class="col-md-2">
                                                    <label class="label-cadastro font-weight-bold h6" for="">Estado Civil</label>
                                                    <select name="uf_endereco" class="custom-select d-block w-100" id="estado" required>
                                                        <option value="" id="escolha">Escolha...</option>
                                                        <option value="AC" id="AC">Casado(a)</option>
                                                        <option value="AL" id="AL">Solteiro(a)</option>
                                                        <option value="AP" id="AP">Divorciado(a)</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="label-cadastro h6" for="estado">Profissão</label>
                                                    <select name="uf_endereco" class="custom-select d-block w-100" id="estado" required>
                                                        <option value="" id="escolha">Escolha...</option>
                                                        <option value="AC" id="AC">Médicos</option>
                                                        <option value="AL" id="AL">Outros</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="label-cadastro font-weight-bold h6" for="">Nacionalidade</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                                <div class="col-md-2 offset-1">
                                                    <label class="label-cadastro font-weight-bold h6" for="">Porcentagem</label>
                                                    <input class="form-control text-center col-6" type="text" placeholder="%">
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="card border-info rounded">
                                        <div class="card-header bg-info text-white font-weight-bold text-center p-1">
                                            Sócios
                                        </div>
                                        <div class="card-body">
                                            <div id="div-form-cadastro" hidden>
                                                <div class="row mt-4">
                                                    <div class="col-md-4">
                                                        <label class="label-cadastro font-weight-bold h6" for="">Nome</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="label-cadastro font-weight-bold h6" for="">CPF</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="label-cadastro font-weight-bold h6" for="">RG</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                    <div class="col-md-2 offset-1">
                                                        <label class="label-cadastro font-weight-bold h6" for="">Porcentagem</label>
                                                        <input class="form-control text-center col-6" type="text" placeholder="%">
                                                    </div>
                                                </div>                
                                                <div class="row mt-2">
                                                    <div class="col-md-3">
                                                        <label class="label-cadastro font-weight-bold h6" for="">Email</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="label-cadastro font-weight-bold h6" for="">Telefone</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="label-cadastro font-weight-bold h6" for="">Sexo</label>
                                                        <select name="uf_endereco" class="custom-select d-block w-100" id="estado" required>
                                                            <option value="" id="escolha">Escolha...</option>
                                                            <option value="MASCULINO" id="AC">Masculino</option>
                                                            <option value="FEMININO" id="AL">Feminio</option>
                                                        </select>
                                                    </div>
                                                </div>                               
                                                <div class="row mt-2">
                                                    <div class="col-md-2">
                                                        <label class="label-cadastro font-weight-bold h6" for="">Estado Civil</label>
                                                        <select name="uf_endereco" class="custom-select d-block w-100" id="estado" required>
                                                            <option value="" id="escolha">Escolha...</option>
                                                            <option value="AC" id="AC">Casado(a)</option>
                                                            <option value="AL" id="AL">Solteiro(a)</option>
                                                            <option value="AP" id="AP">Divorciado(a)</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="label-cadastro h6" for="estado">Profissão</label>
                                                        <select name="uf_endereco" class="custom-select d-block w-100" id="estado" required>
                                                            <option value="" id="escolha">Escolha...</option>
                                                            <option value="AC" id="AC">Médicos</option>
                                                            <option value="AL" id="AL">Outros</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="label-cadastro font-weight-bold h6" for="">Nacionalidade</label>
                                                        <input class="form-control" type="text">
                                                    </div>                                                    
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-md-2">
                                                        <label class="label-cadastro font-weight-bold h6" for="">CEP</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="label-cadastro font-weight-bold h6" for="">Endereço</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <label class="label-cadastro font-weight-bold h6" for="">Nº</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                    <!-- <div class="col-md-4">
                                                        <div class="custom-control custom-checkbox mt-4">
                                                            <input type="checkbox" class="custom-control-input" id="check-endereco-empresa">
                                                            <label class="custom-control-label label-cadastro" for="check-endereco-empresa">Endereço da empresa</label>
                                                        </div>
                                                    </div> -->
                                                </div>                                                
                                                <div class="row mt-2">                                                    
                                                    <div class="col-md-2">
                                                        <label class="label-cadastro h6" for="estado">Estado</label>
                                                        <select name="uf_endereco" class="custom-select d-block w-100" id="estado3" required></select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="label-cadastro font-weight-bold h6" for="">Cidade</label>
                                                        <select name="uf_endereco" class="custom-select d-block w-100" id="cidade3" required></select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="label-cadastro font-weight-bold h6" for="">Bairro</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-md-7">
                                                        <label class="label-cadastro font-weight-bold h6" for="">Complemento</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="" id="incluir-socio"></div>
                                            <div class="row mt-3">
                                                <div class="col-12 text-center">
                                                    <button type="button" class="btn btn-secondary btn-padrao font-weight-bold" id="button-incluir-socio">Adicionar Sócio</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="card border-info rounded">
                                        <div class="card-header bg-info text-white font-weight-bold text-center p-1">
                                            Endereço Empresa
                                        </div>
                                        <div class="card-body">
                                            <div class="row mt-2">                        
                                                <div class="col-md-2">
                                                    <label class="label-cadastro font-weight-bold h6" for="">IPTU</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="label-cadastro font-weight-bold h6" for="">Inscrição Imobiliaria/Fiscal</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="label-cadastro font-weight-bold h6" for="">Metragens</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-2">
                                                    <label class="label-cadastro font-weight-bold h6" for="">CEP</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-4">
                                                    <label class="label-cadastro font-weight-bold h6" for="">Endereço</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                                <div class="col-md-1">
                                                    <label class="label-cadastro font-weight-bold h6" for="">Nº</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="custom-control custom-checkbox mt-4">
                                                        <input type="checkbox" class="custom-control-input" id="check-endereco-empresa">
                                                        <label class="custom-control-label label-cadastro" for="check-endereco-empresa">Endereço da empresa</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-7">
                                                    <label class="label-cadastro font-weight-bold h6" for="">Complemento</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-2">
                                                    <label class="label-cadastro h6" for="estado">Estado</label>
                                                    <select name="uf_endereco" class="custom-select d-block w-100" id="estado1" required></select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="label-cadastro font-weight-bold h6" for="">Cidade</label>
                                                    <select name="cidade" class="custom-select d-block w-100" id="cidade1" required></select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="label-cadastro font-weight-bold h6" for="">Bairro</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>                                      

                                            <div id="endereco-socio-adm" hidden>
                                                <div class="row mt-4">
                                                    <div class="col text-center">
                                                        <h5 class="label-cadastro">Endereço Sócio Administrador</h5>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-2">
                                                        <label class="label-cadastro font-weight-bold h6" for="">CEP</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="label-cadastro font-weight-bold h6" for="">IPTU</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="label-cadastro font-weight-bold h6" for="">Inscrição Imobiliaria/Fiscal</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-md-5">
                                                        <label class="label-cadastro font-weight-bold h6" for="">Endereço</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="label-cadastro font-weight-bold h6" for="">Nº</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-md-2">
                                                        <label class="label-cadastro h6" for="estado">Estado</label>
                                                        <select name="uf_endereco" class="custom-select d-block w-100" id="estado2" required></select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="label-cadastro font-weight-bold h6" for="">Cidade</label>
                                                        <select name="uf_endereco" class="custom-select d-block w-100" id="cidade2" required></select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="label-cadastro font-weight-bold h6" for="">Bairro</label>
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>                                                                             
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="card border-info rounded">
                                        <div class="card-header bg-info text-white font-weight-bold text-center p-1">
                                            Documentos
                                        </div>
                                        <div class="card-body">
                                            <div class="row mt-2">
                                                <div class="col-md-4">
                                                    <label class="label-cadastro font-weight-bold h6" for="">Documento com Foto</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile">
                                                        <label class="custom-file-label" for="customFile"></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="label-cadastro font-weight-bold h6" for="">CPF</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile">
                                                        <label class="custom-file-label" for="customFile"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row my-3">
                                                <div class="col-md-4">
                                                    <label class="label-cadastro font-weight-bold h6" for="">Comprovante Residência</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile">
                                                        <label class="custom-file-label" for="customFile"></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="label-cadastro font-weight-bold h6" for="">Certidão Casamento/Divórcio</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile">
                                                        <label class="custom-file-label" for="customFile"></label>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    <!-- <div class="row mt-3 mb-4">
                                        <div class="col text-center">
                                            <h5 class="label-cadastro">Sócios</h5>
                                        </div>
                                    </div>

                                    <div class="" id="incluir-socio">

                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12 text-center">
                                            <button type="button" class="btn btn-secondary btn-padrao font-weight-bold" id="button-teste">Adicionar Sócio</button>
                                        </div>
                                    </div> -->
                                    <div class="row mt-5">
                                        <div class="col-12 text-center">
                                            <button type="button" class="btn btn-success btn-padrao btn-lg"><strong>Salvar</strong></button>
                                        </div>
                                    </div>
                                </div>

    <!-- ********************************** COLLAPSE TRANSFERENCIA *********************************************** -->

                                <div class="collapse" id="collapseTransferencia" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="row mt-2">
                                        <div class="col-md-2">
                                            <label class="label-cadastro font-weight-bold h6" for="">CPF Cliente</label>
                                            <input class="form-control" type="text">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="label-cadastro font-weight-bold h6" for="">CNPJ Cliente</label>
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-2">
                                            <label class="label-cadastro font-weight-bold h6" for="">Competência</label>
                                            <input class="form-control" type="text">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="label-cadastro font-weight-bold h6" for="">Escritório Antigo</label>
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>                   

                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="checkEnviaUsuario" checked>
                                                <label class="custom-control-label label-cadastro" for="checkEnviaUsuario">Enviar usuário sistema (contrato)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-2">
                                            <label class="label-cadastro font-weight-bold h6" for="">Data Visita</label>
                                            <input class="form-control" type="text">
                                        </div>
                                        <div class="col-md=5">
                                            <label class="label-cadastro font-weight-bold h6" for="">Enviar Arquivo</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-12 text-center">
                                            <button type="button" class="btn btn-success btn-padrao btn-lg"><strong>Salvar</strong></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>            
            </div>        
        </div>    
    </div>


<?php include __DIR__ . '/../modal/comercial/cadastro-empresa-abertura.php';?>
<?php include __DIR__ . '/../modal/comercial/cadastro-empresa-transferencia.php';?>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script type="text/javascript">
    new dgCidadesEstados({
        cidade: document.getElementById('cidade1'),
        estado: document.getElementById('estado1')
    });
    new dgCidadesEstados({
        cidade: document.getElementById('cidade2'),
        estado: document.getElementById('estado2')
    });
    new dgCidadesEstados({
        cidade: document.getElementById('cidade3'),
        estado: document.getElementById('estado3')
    });
</script>

<script type="text/javascript">

    $('#check-endereco-empresa').change(function() {
        $("#endereco-socio-adm").prop("hidden", !this.checked);
    });


    $(document).ready(function(){
        $("#button-incluir-socio").click(function(){
            $("#div-form-cadastro").clone().appendTo("#incluir-socio");
            $("#div-form-cadastro").removeAttr('hidden');
        });
    });

    $('#radio-eireli').change(function() {
        $("#button-incluir-socio").removeClass("disabled", !this.checked);
    });

</script>

<script type="text/javascript">
    var cep = document.getElementById("cep");
    cep.addEventListener("keyup", function(){
        if(cep.value.length == 9){
            $("#cep").blur();
            carregaEndereco();
        }
    });

    function carregaEndereco(){
        var xhttp = new XMLHttpRequest();

        xhttp.open("POST", "../../web-api/consulta-endereco.php", true);
        xhttp.setRequestHeader("Content-type", "application/json");

        var entrada = document.getElementById("cep");
        var cepObjeto = {};

        cepObjeto['cep'] = entrada.value;

        var jsonParaEnviar = JSON.stringify(cepObjeto);

        xhttp.send(jsonParaEnviar);

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200){
                populaEndereco(this.responseText);
            }
        };
    }

    function populaEndereco(jsonEndereco){
        var enderecoObjeto = JSON.parse(jsonEndereco);

        var logradouro =  document.getElementById('logradouro');
        logradouro.setAttribute("value", enderecoObjeto['logradouro']);

        var cidade =  document.getElementById('cidade');
        cidade.setAttribute("value", enderecoObjeto['localidade']);

        var bairro =  document.getElementById('bairro');
        bairro.setAttribute("value", enderecoObjeto['bairro']);

        var complemento =  document.getElementById('complemento');
        complemento.setAttribute("value", enderecoObjeto['complemento']);

        var estado =  document.getElementById(enderecoObjeto['uf']);
        estado.selected = "true";
    }
</script>

<script type="text/javascript">
    var divIncluirSocio = document.getElementById('incluir-socio');
    var quantidadeSocio = 0;

    function adicionaSocio(){
        quantidadeSocio++;

        var divColuna = document.createElement("DIV");
        divColuna.className = 'col-md-4 mb-3 label-cadastro mt-3';

        var label = document.createElement("LABEL");
        label.innerHTML = 'RG Socio';
        divColuna.appendChild(label);

        var input = document.createElement("INPUT");
        input.className = 'form-control';
        input.setAttribute('type', 'text');
        input.setAttribute('required', 'true');
        input.setAttribute('autocomplete', 'off');
        input.setAttribute('name', 'socios[' + quantidadeSocio + '][nome]');
        divColuna.appendChild(input);

        var divInvFeed = document.createElement("DIV");
        divInvFeed.className = 'invalid-feedback';
        divInvFeed.innerHTML = 'Obrigatório';
        divColuna.appendChild(divInvFeed);

        var divColunaPor = document.createElement("DIV");
        divColunaPor.className = 'col-md-4 mb-3 label-cadastro mt-3';

        var labelCapital = document.createElement("LABEL");
        labelCapital.innerHTML = 'Nome Socio';
        divColunaPor.appendChild(labelCapital);

        var inputCapital = document.createElement("INPUT");
        inputCapital.className = 'form-control';
        inputCapital.setAttribute('type', 'text');
        inputCapital.setAttribute('required', 'true');
        inputCapital.setAttribute('autocomplete', 'off');
        inputCapital.setAttribute('name', 'socios[' + quantidadeSocio + '][porcentagem]');
        divColunaPor.appendChild(inputCapital);

        var divInvFeed = document.createElement("DIV");
        divInvFeed.className = 'invalid-feedback';
        divInvFeed.innerHTML = 'Obrigatório';
        divColunaPor.appendChild(divInvFeed);

        var divColunaPorDois = document.createElement("DIV");
        divColunaPorDois.className = 'col-md-4 mb-3 label-cadastro mt-3';

        var label = document.createElement("LABEL");
        label.innerHTML = 'CPF Socio';
        divColunaPorDois.appendChild(label);

        var input = document.createElement("INPUT");
        input.className = 'form-control';
        input.setAttribute('type', 'text');
        input.setAttribute('required', 'true');
        input.setAttribute('autocomplete', 'off');
        input.setAttribute('name', 'socios[' + quantidadeSocio + '][nome]');
        divColunaPorDois.appendChild(input);

        var divInvFeed = document.createElement("DIV");
        divInvFeed.className = 'invalid-feedback';
        divInvFeed.innerHTML = 'Obrigatório';
        divColunaPorDois.appendChild(divInvFeed);

        divIncluirSocio.appendChild(divColuna);
        divIncluirSocio.appendChild(divColunaPor);
        divIncluirSocio.appendChild(divColunaPorDois);

        // *********************************************************************

        var divColuna = document.createElement("DIV");
        divColuna.className = 'col-md-4 mb-3 label-cadastro mt-3';

        var label = document.createElement("LABEL");
        label.innerHTML = 'RG Socio';
        divColuna.appendChild(label);

        var input = document.createElement("INPUT");
        input.className = 'form-control';
        input.setAttribute('type', 'text');
        input.setAttribute('required', 'true');
        input.setAttribute('autocomplete', 'off');
        input.setAttribute('name', 'socios[' + quantidadeSocio + '][nome]');
        divColuna.appendChild(input);

        var divInvFeed = document.createElement("DIV");
        divInvFeed.className = 'invalid-feedback';
        divInvFeed.innerHTML = 'Obrigatório';
        divColuna.appendChild(divInvFeed);

        var divColunaPor = document.createElement("DIV");
        divColunaPor.className = 'col-md-4 mb-3 label-cadastro mt-3';

        var labelCapital = document.createElement("LABEL");
        labelCapital.innerHTML = 'Email Socio';
        divColunaPor.appendChild(labelCapital);

        var inputCapital = document.createElement("INPUT");
        inputCapital.className = 'form-control';
        inputCapital.setAttribute('type', 'text');
        inputCapital.setAttribute('required', 'true');
        inputCapital.setAttribute('autocomplete', 'off');
        inputCapital.setAttribute('name', 'socios[' + quantidadeSocio + '][porcentagem]');
        divColunaPor.appendChild(inputCapital);

        var divInvFeed = document.createElement("DIV");
        divInvFeed.className = 'invalid-feedback';
        divInvFeed.innerHTML = 'Obrigatório';
        divColunaPor.appendChild(divInvFeed);

        var divColunaPorDois = document.createElement("DIV");
        divColunaPorDois.className = 'col-md-4 mb-3 label-cadastro mt-3';

        var label = document.createElement("LABEL");
        label.innerHTML = 'CPF Socio';
        divColunaPorDois.appendChild(label);

        var input = document.createElement("INPUT");
        input.className = 'form-control';
        input.setAttribute('type', 'text');
        input.setAttribute('required', 'true');
        input.setAttribute('autocomplete', 'off');
        input.setAttribute('name', 'socios[' + quantidadeSocio + '][nome]');
        divColunaPorDois.appendChild(input);

        var divInvFeed = document.createElement("DIV");
        divInvFeed.className = 'invalid-feedback';
        divInvFeed.innerHTML = 'Obrigatório';
        divColunaPorDois.appendChild(divInvFeed);

        divIncluirSocio.appendChild(divColuna);
        divIncluirSocio.appendChild(divColunaPor);
        divIncluirSocio.appendChild(divColunaPorDois);

        // *********************************************************************

        var divColunaPor = document.createElement("DIV");
        divColunaPor.className = 'col-md-6 mb-3 label-cadastro';

        var labelCapital = document.createElement("LABEL");
        labelCapital.innerHTML = 'Porcentagem Socio';
        divColunaPor.appendChild(labelCapital);

        var inputCapital = document.createElement("INPUT");
        inputCapital.className = 'form-control col-8';
        inputCapital.setAttribute('type', 'text');
        inputCapital.setAttribute('required', 'true');
        inputCapital.setAttribute('autocomplete', 'off');
        inputCapital.setAttribute('name', 'socios[' + quantidadeSocio + '][porcentagem]');
        divColunaPor.appendChild(inputCapital);

        var divInvFeed = document.createElement("DIV");
        divInvFeed.className = 'invalid-feedback';
        divInvFeed.innerHTML = 'Obrigatório';
        divColunaPor.appendChild(divInvFeed);

        divIncluirSocio.appendChild(divColuna);
        divIncluirSocio.appendChild(divColunaPor);
        
        // *********************************************************************
        
        var divColuna = document.createElement("DIV");
        divColuna.className = 'col-md-12 mb-3 label-cadastro';

        var label = document.createElement("LABEL");
        label.innerHTML = 'CEP Socio';
        divColuna.appendChild(label);

        var input = document.createElement("INPUT");
        input.className = 'form-control col-3';
        input.setAttribute('type', 'text');
        input.setAttribute('required', 'true');
        input.setAttribute('autocomplete', 'off');
        input.setAttribute('name', 'socios[' + quantidadeSocio + '][nome]');
        divColuna.appendChild(input);

        var divInvFeed = document.createElement("DIV");
        divInvFeed.className = 'invalid-feedback';
        divInvFeed.innerHTML = 'Obrigatório';
        divColuna.appendChild(divInvFeed);

        divIncluirSocio.appendChild(divColuna);

        // *********************************************************************
        
        var divColuna = document.createElement("DIV");
        divColuna.className = 'col-md-5 mb-3 label-cadastro';

        var label = document.createElement("LABEL");
        label.innerHTML = 'Endereço Socio';
        divColuna.appendChild(label);

        var input = document.createElement("INPUT");
        input.className = 'form-control';
        input.setAttribute('type', 'text');
        input.setAttribute('required', 'true');
        input.setAttribute('autocomplete', 'off');
        input.setAttribute('name', 'socios[' + quantidadeSocio + '][nome]');
        divColuna.appendChild(input);

        var divInvFeed = document.createElement("DIV");
        divInvFeed.className = 'invalid-feedback';
        divInvFeed.innerHTML = 'Obrigatório';
        divColuna.appendChild(divInvFeed);

        divIncluirSocio.appendChild(divColuna);

        // *********************************************************************
        
        var divColuna = document.createElement("DIV");
        divColuna.className = 'col-md-4 mb-3 label-cadastro';

        var label = document.createElement("LABEL");
        label.innerHTML = 'Email Socio';
        divColuna.appendChild(label);

        var input = document.createElement("INPUT");
        input.className = 'form-control';
        input.setAttribute('type', 'text');
        input.setAttribute('required', 'true');
        input.setAttribute('autocomplete', 'off');
        input.setAttribute('name', 'socios[' + quantidadeSocio + '][nome]');
        divColuna.appendChild(input);

        var divInvFeed = document.createElement("DIV");
        divInvFeed.className = 'invalid-feedback';
        divInvFeed.innerHTML = 'Obrigatório';
        divColuna.appendChild(divInvFeed);

        var divColunaPor = document.createElement("DIV");
        divColunaPor.className = 'col-md-6 mb-3 label-cadastro';

        var labelCapital = document.createElement("LABEL");
        labelCapital.innerHTML = 'Telefone Socio';
        divColunaPor.appendChild(labelCapital);

        var inputCapital = document.createElement("INPUT");
        inputCapital.className = 'form-control col-8';
        inputCapital.setAttribute('type', 'text');
        inputCapital.setAttribute('required', 'true');
        inputCapital.setAttribute('autocomplete', 'off');
        inputCapital.setAttribute('name', 'socios[' + quantidadeSocio + '][porcentagem]');
        divColunaPor.appendChild(inputCapital);

        var divInvFeed = document.createElement("DIV");
        divInvFeed.className = 'invalid-feedback';
        divInvFeed.innerHTML = 'Obrigatório';
        divColunaPor.appendChild(divInvFeed);

        divIncluirSocio.appendChild(divColuna);
        divIncluirSocio.appendChild(divColunaPor);
    }
</script>

<script type="text/javascript">
    $("#cep").mask("00000-000");
    $("#cnpj").mask("00.000.000/0000-00", {reverse: true});
    $("#capital-social").mask('000.000.000,00', {reverse: true});
    $("#inicio-atividades").mask('00/00/0000');
    $("#sn-data").mask('00/00/0000');
</script>
