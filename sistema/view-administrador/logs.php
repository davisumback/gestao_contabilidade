<?php
require_once('header.php');
require_once('menu-topo.php');
require_once('menu-left.php');
require_once('../cabecalho.php');

$caminhoBase = 'http://35.229.74.54/logs';  
$arquivo = 'php_errors.log';
$caminho = $caminhoBase . '/' . $arquivo;

if (in_array('arquivo', $_GET)) {
    $caminho = $caminhoBase . '/' . $_GET['arquivo'];
}
?>

<div class="container-fluid">
    <div class="text-center mt-2 mb-5">
        <form action="../controllers/log/deleta.php" method="post">
            <input name="log" value="php_errors.log" hidden>
            <button type="submit" class="btn btn-padrao btn-info">Limpar</button>
        </form>
    </div>
    <?php
        $retorno = \App\Helper\Helpers::isUrl($caminho);

        if ($retorno == 200) {
            $lines = file($caminho);
            // Percorre o array, mostrando o número da linha que está
            foreach ($lines as $line_num => $line) {
                if (strpos($line, 'Notice')) {
                    $cor = 'text-info';
                } else if (strpos($line, 'Warning')){
                    $cor = 'text-warning';
                } else if (strpos($line, 'Fatal')) {
                    $cor = 'text-danger';
                }    
                echo '<span class="' . $cor . '">Linha #<b>' . intval($line_num + 1) . '</b> : ' . $line . '<span><br>';                
            }
        }
    ?>
</div>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>