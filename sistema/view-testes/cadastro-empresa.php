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
            <div class="col-md-11">
                <div class="card mb-5">
                    <div class="card-header bg-cor-accent-primaria text-center">
                        <i class="fa fa-user"></i><strong class="card-title pl-md-2">Cadastro de Empresa</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="label-cadastro">Nome</h5>
                                <h5 class="mt-2">Lorem ipsum dolor sit</h5>
                            </div>
                            <div class="col-md-4">
                                <h5 class="label-cadastro">E-mail</h5>
                                <h5 class="mt-2">exemplo@exemplo.com.br</h5>
                            </div>
                            <div class="col-md-4">
                                <h5 class="label-cadastro">Telefone</h5>
                                <h5 class="mt-2">44 99999-9999</h5>
                            </div>                            
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <h5 class="label-cadastro">Sexo</h5>
                                <h5 class="mt-2">Masculino</h5>
                            </div>
                            <div class="col-md-4">
                                <h5 class="label-cadastro">Profiss??o</h5>
                                <h5 class="mt-2">M??dico</h5>
                            </div>
                            <div class="col-md-4">
                                <h5 class="label-cadastro">Especialidade</h5>
                                <h5 class="mt-2">Todas</h5>
                            </div>                            
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <h5 class="label-cadastro">Endere??o</h5>
                                <h5 class="mt-2">Av. Pedro Taques, 294</h5>
                                <h5 class="mt-2">Maring?? - PR - 87030-008</h5>
                            </div>
                            <div class="col-md-4">
                                <h5 class="label-cadastro">Cl??nica F??sica</h5>
                                <h5 class="mt-2">Sim (ou n??o)</h5>
                            </div>
                        </div>
                        <div class="row mt-4">
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
                                <div class="col-md-5 text-center">
                                    <h3 class="label-cadastro">Financeiro</h3>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-5">
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
                                                <td class="font-weight-bold">
                                                    <input class="form-control col-4" type="text" value="10">
                                                </td>
                                                <td class="label-cadastro">S??cios</td>
                                                <td class="font-weight-bold">R$40,00</td>
                                            </tr>
                                            <tr class="">
                                                <td class="font-weight-bold">
                                                    <input class="form-control col-4" type="text" value="10">
                                                </td>
                                                <td class="label-cadastro">Funcion??rios</td>
                                                <td class="font-weight-bold">R$40,00</td>
                                            </tr>
                                            <tr class="">
                                                <td class="font-weight-bold">
                                                    <input class="form-control col-4" type="text" value="10">
                                                </td>
                                                <td class="label-cadastro">Dom??sticas</td>
                                                <td class="font-weight-bold">R$70,00</td>
                                            </tr>
                                            <tr class="">
                                                <td class="font-weight-bold">
                                                    <input class="form-control col-4" type="text" value="SIM">
                                                </td>
                                                <td class="label-cadastro">Gestor Administrativo</td>
                                                <td class="font-weight-bold">R$178,00</td>
                                            </tr>
                                            <tr class="">
                                                <td class="font-weight-bold">
                                                    <input class="form-control col-4" type="text" value="1">
                                                </td>
                                                <td class="label-cadastro">Contabilidade</td>
                                                <td class="font-weight-bold">R$178,00</td>
                                            </tr>
                                            <tr class="">
                                                <td></td>
                                                <td class="label-cadastro">Total</td>
                                                <td class="font-weight-bold">R$450,00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col text-right">
                                    <button type="button" class="btn btn-success btn-padrao font-weight-bold">
                                        Salvar
                                    </button>  
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-3">
                                <div class="col text-center">
                                    <h5 class="label-cadastro">Situa????o</h5>
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
                                            Transfer??ncia
                                        </button>                                
                                    </div>
                                </div>

    <!-- ********************************** COLLAPSE ABERTURA *********************************************** -->

                                <div class="collapse" id="collapseAbertura" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="row">
                                        <div class="col-6 mb-2 label-cadastro text-center">
                                            <h5 class="font-weight-bold">Tipo Societ??rio</h5>
                                        </div>
                                        <div class="col-6 mb-2 label-cadastro text-center">
                                            <h5 class="font-weight-bold">Tipo do Estabelecimento</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 mb-2 label-cadastro text-center">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline1">LTDA</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline2">EIRELI</label>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-2 label-cadastro text-center">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline3" name="customRadioInline2" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline3">F??sico</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline4" name="customRadioInline2" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline4">Ponto de refer??ncia</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="div-form-cadastro">
                                        <div class="row mt-2">
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
                                                <label class="label-cadastro h6" for="estado">Profiss??o</label>
                                                <select name="uf_endereco" class="custom-select d-block w-100" id="estado" required>
                                                    <option value="" id="escolha">Escolha...</option>
                                                    <option value="AC" id="AC">M??dicos</option>
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
                                                <label class="label-cadastro font-weight-bold h6" for="">Porcentagem</label>
                                                <input class="form-control text-center col-6" type="text" placeholder="%">
                                            </div>
                                        </div>
                                    </div>                                    
                                    <hr>
                                    <div class="row mt-2">                        
                                        <div class="col-md-2">
                                            <label class="label-cadastro font-weight-bold h6" for="">IPTU</label>
                                            <input class="form-control" type="text">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="label-cadastro font-weight-bold h6" for="">Inscri????o Imobiliaria/Fiscal</label>
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
                                            <label class="label-cadastro font-weight-bold h6" for="">Endere??o</label>
                                            <input class="form-control" type="text">
                                        </div>
                                        <div class="col-md-1">
                                            <label class="label-cadastro font-weight-bold h6" for="">N??</label>
                                            <input class="form-control" type="text">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="custom-control custom-checkbox mt-4">
                                                <input type="checkbox" class="custom-control-input" id="check-endereco-empresa">
                                                <label class="custom-control-label label-cadastro" for="check-endereco-empresa">Endere??o da empresa</label>
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
                                        <div class="col-md-3">
                                            <label class="label-cadastro font-weight-bold h6" for="">Bairro</label>
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <label class="label-cadastro font-weight-bold h6" for="">Cidade</label>
                                            <input class="form-control" type="text">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="label-cadastro h6" for="estado">Estado</label>
                                            <select name="uf_endereco" class="custom-select d-block w-100" id="estado" required>
                                                <option value="" id="escolha">Escolha...</option>
                                                <option value="AC" id="AC">Acre</option>
                                                <option value="AL" id="AL">Alagoas</option>
                                                <option value="AP" id="AP">Amap??</option>
                                                <option value="AM" id="AM">Amazonas</option>
                                                <option value="BA" id="BA">Bahia</option>
                                                <option value="CE" id="CE">Cear??</option>
                                                <option value="DF" id="DF">Distrito Federal</option>
                                                <option value="ES" id="ES">Esp??rito Santo</option>
                                                <option value="GO" id="GO">Goi??s</option>
                                                <option value="MA" id="MA">Maranh??o</option>
                                                <option value="MT" id="MT">Mato Grosso</option>
                                                <option value="MS" id="MS">Mato Grosso do Sul</option>
                                                <option value="MG" id="MG">Minas Gerais</option>
                                                <option value="PA" id="PA">Par??</option>
                                                <option value="PB" id="PB">Para??ba</option>
                                                <option value="PR" id="PR">Paran??</option>
                                                <option value="PE" id="PE">Pernambuco</option>
                                                <option value="PI" id="PI">Piau??</option>
                                                <option value="RJ" id="RJ">Rio de Janeiro</option>
                                                <option value="RN" id="RN">Rio Grande do Norte</option>
                                                <option value="RS" id="RS">Rio Grande do Sul</option>
                                                <option value="RO" id="RO">Rond??nia</option>
                                                <option value="RR" id="RR">Roraima</option>
                                                <option value="SC" id="SC">Santa Catarina</option>
                                                <option value="SP" id="SP">S??o Paulo</option>
                                                <option value="SE" id="SE">Sergipe</option>
                                                <option value="TO" id="TO">Tocantins</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            <label class="label-cadastro font-weight-bold h6" for="">Documento com Foto</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <label class="label-cadastro font-weight-bold h6" for="">CPF</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile"></label>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <label class="label-cadastro font-weight-bold h6" for="">Comprovante Resid??ncia</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile"></label>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <label class="label-cadastro font-weight-bold h6" for="">Certid??o Casamento/Div??rcio</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile"></label>
                                            </div>
                                        </div>
                                    </div>   

                                    <div id="endereco-socio-adm" hidden>
                                        <div class="row mt-4">
                                            <div class="col text-center">
                                                <h5 class="label-cadastro">Endere??o S??cio Administrador</h5>
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
                                                <label class="label-cadastro font-weight-bold h6" for="">Inscri????o Imobiliaria/Fiscal</label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-5">
                                                <label class="label-cadastro font-weight-bold h6" for="">Endere??o</label>
                                                <input class="form-control" type="text">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="label-cadastro font-weight-bold h6" for="">N??</label>
                                                <input class="form-control" type="text">
                                            </div>
                                            <div class="col-md-4">
                                                <div class="custom-control custom-checkbox mt-4">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                    <label class="custom-control-label label-cadastro" for="customCheck1">Endere??o da empresa</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-5">
                                                <label class="label-cadastro font-weight-bold h6" for="">Bairro</label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                <label class="label-cadastro font-weight-bold h6" for="">Cidade</label>
                                                <input class="form-control" type="text">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="label-cadastro h6" for="estado">Estado</label>
                                                <select name="uf_endereco" class="custom-select d-block w-100" id="estado" required>
                                                    <option value="" id="escolha">Escolha...</option>
                                                    <option value="AC" id="AC">Acre</option>
                                                    <option value="AL" id="AL">Alagoas</option>
                                                    <option value="AP" id="AP">Amap??</option>
                                                    <option value="AM" id="AM">Amazonas</option>
                                                    <option value="BA" id="BA">Bahia</option>
                                                    <option value="CE" id="CE">Cear??</option>
                                                    <option value="DF" id="DF">Distrito Federal</option>
                                                    <option value="ES" id="ES">Esp??rito Santo</option>
                                                    <option value="GO" id="GO">Goi??s</option>
                                                    <option value="MA" id="MA">Maranh??o</option>
                                                    <option value="MT" id="MT">Mato Grosso</option>
                                                    <option value="MS" id="MS">Mato Grosso do Sul</option>
                                                    <option value="MG" id="MG">Minas Gerais</option>
                                                    <option value="PA" id="PA">Par??</option>
                                                    <option value="PB" id="PB">Para??ba</option>
                                                    <option value="PR" id="PR">Paran??</option>
                                                    <option value="PE" id="PE">Pernambuco</option>
                                                    <option value="PI" id="PI">Piau??</option>
                                                    <option value="RJ" id="RJ">Rio de Janeiro</option>
                                                    <option value="RN" id="RN">Rio Grande do Norte</option>
                                                    <option value="RS" id="RS">Rio Grande do Sul</option>
                                                    <option value="RO" id="RO">Rond??nia</option>
                                                    <option value="RR" id="RR">Roraima</option>
                                                    <option value="SC" id="SC">Santa Catarina</option>
                                                    <option value="SP" id="SP">S??o Paulo</option>
                                                    <option value="SE" id="SE">Sergipe</option>
                                                    <option value="TO" id="TO">Tocantins</option>
                                                </select>
                                            </div>
                                        </div>                                                                             
                                    </div>
                                    <hr>
                                    <div class="row mt-3 mb-4">
                                        <div class="col text-center">
                                            <h5 class="label-cadastro">S??cios</h5>
                                        </div>
                                    </div>

                                    <div class="" id="incluir-socio">

                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12 text-center">
                                            <button type="button" class="btn btn-secondary btn-padrao font-weight-bold" id="button-teste"x>Adicionar S??cio</button>
                                        </div>
                                    </div>
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
                                            <label class="label-cadastro font-weight-bold h6" for="">Compet??ncia</label>
                                            <input class="form-control" type="text">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="label-cadastro font-weight-bold h6" for="">Escrit??rio Antigo</label>
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>                        

                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="checkEnviaUsuario" checked>
                                                <label class="custom-control-label label-cadastro" for="checkEnviaUsuario">Enviar usu??rio sistema (contrato)</label>
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

    $('#check-endereco-empresa').change(function() {
        $("#endereco-socio-adm").prop("hidden", !this.checked);
    });


    $(document).ready(function(){
        $("#button-teste").click(function(){
            $("#div-form-cadastro").clone().appendTo("#incluir-socio");
        });
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
        divInvFeed.innerHTML = 'Obrigat??rio';
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
        divInvFeed.innerHTML = 'Obrigat??rio';
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
        divInvFeed.innerHTML = 'Obrigat??rio';
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
        divInvFeed.innerHTML = 'Obrigat??rio';
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
        divInvFeed.innerHTML = 'Obrigat??rio';
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
        divInvFeed.innerHTML = 'Obrigat??rio';
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
        divInvFeed.innerHTML = 'Obrigat??rio';
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
        divInvFeed.innerHTML = 'Obrigat??rio';
        divColuna.appendChild(divInvFeed);

        divIncluirSocio.appendChild(divColuna);

        // *********************************************************************
        
        var divColuna = document.createElement("DIV");
        divColuna.className = 'col-md-5 mb-3 label-cadastro';

        var label = document.createElement("LABEL");
        label.innerHTML = 'Endere??o Socio';
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
        divInvFeed.innerHTML = 'Obrigat??rio';
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
        divInvFeed.innerHTML = 'Obrigat??rio';
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
        divInvFeed.innerHTML = 'Obrigat??rio';
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
