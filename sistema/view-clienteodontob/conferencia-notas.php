<?php
use App\DAO\ClienteDAO;

require_once('header.php');
require_once('menu-topo.php');
require_once('menu-left.php');
require_once('../template-odontob/cabecalho.php');

?>

<div class="container-fluid">
    <div class="row justify-content-around mt-5">
        <div class="col-md-8">
            <div class="card bg-light border-danger rounded-top mb-3">
                <div class="card-header bg-danger text-white text-center font-weight-bold">Titulo</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Empresa</th>
                                    <th class="border-top-0" scope="col">Produtos</th>
                                    <th class="border-top-0" scope="col">Valor</th>
                                    <th class="border-top-0" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">Nome Exemplo</td>
                                    <td>Nome Exemplo</td>
                                    <td>R$ 1.000,00</td>                                                
                                    <td>
                                        <button type="button" class="btn btn-dark btn-padrao font-weight-bold" disabled>Utilizada</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Nome Exemplo</td>
                                    <td>Nome Exemplo</td>
                                    <td>R$ 1.000,00</td>                                                
                                    <td>
                                        <button type="button" class="btn btn-success btn-padrao font-weight-bold btn-utilizar">Utilizar</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Nome Exemplo</td>
                                    <td>Nome Exemplo</td>
                                    <td>R$ 1.000,00</td>                                                
                                    <td>
                                        <button type="button" class="btn btn-success btn-padrao font-weight-bold btn-utilizar">Utilizar</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">Nome Exemplo</td>
                                    <td>Nome Exemplo</td>
                                    <td>R$ 1.000,00</td>                                                
                                    <td>
                                        <button type="button" class="btn btn-success btn-padrao font-weight-bold btn-utilizar">Utilizar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>            
                    <div class="alert alert-dark" role="alert">
                        <span class="font-weight-bold">ATENÇÃO!</span> As notas citadas a cima são exclusivas do consultório ou da pessoa física. Nenhuma nota podera ser dividida!
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>