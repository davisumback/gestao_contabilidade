<?php
require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao('Relatórios =)');
require_once('menu-left.php');
require_once('../cabecalho.php');
?>

<div class="container-fluid">
    <div class="alert alert-light text-center pt-4 pb-4 text-secondary" role="alert">
        <strong>Área para emissão de relatórios</strong>
    </div>

    <div class="text-center">
        <button type="button" data-toggle="modal" data-target="#empresasLiberadas" class="btn btn-padrao btn-sm btn-info">Empresas Liberadas</button>
    </div>
</div>

<?php include __DIR__ . '/../modal/relatorios/empresas-liberadas.php'; ?>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>

<script>
    $("#data-pesquisa").mask("00/00/0000");
</script>

<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('pesquisa-empresas-liberadas');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        var input = document.getElementById('data-pesquisa');

                        vaiParaNovaAba('../views/pdf/empresas-liberacoes/liberadas.php?dataPesquisa=' + input.value);
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
