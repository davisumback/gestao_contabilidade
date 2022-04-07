<?php
use App\Helper\Mensagem;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao('Oportunidades :)');
require_once('menu-left.php');
require_once('../template-medcontabil/cabecalho.php');
?>

<?=Mensagem::getMensagem($_COOKIE, 'resultadoInsercaoConta', 'mensagemInsercaoConta');?>

<div class="card">
    <div class="card-header bg-info text-white text-center font-weight-bold">
        Pesquisar Oportunidades
    </div>
    <div class="card-body">
        <div class="row justify-content-around">
            <div class="col-2 text-center">
                <div class="form-group">
                    <label class="label-cadastro" for="">Cidade</label>
                    <input type="email" class="form-control" id="">
                </div>
            </div>
        </div>
        <hr>
        <div class="card border-info">
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <h5 class="label-cadastro">Cidade</h5>
                        <h6 class="mt-1">Maringá</h6>
                    </div>
                    <div class="col-2">
                        <h5 class="label-cadastro">Estado</h5>
                        <h6 class="mt-1">Paraná</h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-2">
                        <h5 class="label-cadastro">Local</h5>
                        <h6 class="mt-1">Lorem ipsum</h6>
                    </div>
                    <div class="col-2">
                        <h5 class="label-cadastro">Contato</h5>
                        <h6 class="mt-1">Lorem ipsum</h6>
                    </div>
                    <div class="col-2">
                        <h5 class="label-cadastro">Contato</h5>
                        <h6 class="mt-1">(99) 9 9999-9999 </h6>
                    </div>
                    <div class="col-2">
                        <h5 class="label-cadastro">Edital</h5>
                        <a class="mt-1 font-weight-bold" href="">Visualizar</a>
                    </div>
                    <div class="col-2">
                        <h5 class="label-cadastro">Data Validade</h5>
                        <h6 class="mt-1 font-weight-bold" href="">01/01/2019</h6>
                    </div>
                </div>                
            </div>
        </div>
        <div class="card border-info">
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <h5 class="label-cadastro">Cidade</h5>
                        <h6 class="mt-1">Maringá</h6>
                    </div>
                    <div class="col-2">
                        <h5 class="label-cadastro">Estado</h5>
                        <h6 class="mt-1">Paraná</h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-2">
                        <h5 class="label-cadastro">Local</h5>
                        <h6 class="mt-1">Lorem ipsum</h6>
                    </div>
                    <div class="col-2">
                        <h5 class="label-cadastro">Contato</h5>
                        <h6 class="mt-1">Lorem ipsum</h6>
                    </div>
                    <div class="col-2">
                        <h5 class="label-cadastro">Contato</h5>
                        <h6 class="mt-1">(99) 9 9999-9999 </h6>
                    </div>
                    <div class="col-2">
                        <h5 class="label-cadastro">Edital</h5>
                        <a class="mt-1 font-weight-bold" href="">Visualizar</a>
                    </div>
                    <div class="col-2">
                        <h5 class="label-cadastro">Data Validade</h5>
                        <h6 class="mt-1 font-weight-bold" href="">01/01/2019</h6>
                    </div>
                </div>                
            </div>
        </div>
        <div class="card border-info">
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <h5 class="label-cadastro">Cidade</h5>
                        <h6 class="mt-1">Maringá</h6>
                    </div>
                    <div class="col-2">
                        <h5 class="label-cadastro">Estado</h5>
                        <h6 class="mt-1">Paraná</h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-2">
                        <h5 class="label-cadastro">Local</h5>
                        <h6 class="mt-1">Lorem ipsum</h6>
                    </div>
                    <div class="col-2">
                        <h5 class="label-cadastro">Contato</h5>
                        <h6 class="mt-1">Lorem ipsum</h6>
                    </div>
                    <div class="col-2">
                        <h5 class="label-cadastro">Contato</h5>
                        <h6 class="mt-1">(99) 9 9999-9999 </h6>
                    </div>
                    <div class="col-2">
                        <h5 class="label-cadastro">Edital</h5>
                        <a class="mt-1 font-weight-bold" href="">Visualizar</a>
                    </div>
                    <div class="col-2">
                        <h5 class="label-cadastro">Data Validade</h5>
                        <h6 class="mt-1 font-weight-bold" href="">01/01/2019</h6>
                    </div>
                </div>                
            </div>
        </div>    
    </div>
</div>

<?php
require_once('rodape.php');
require_once('../template-medcontabil/rodape.php');
?>

<script src="../assets/custom-js/autocomplete.js"></script>
