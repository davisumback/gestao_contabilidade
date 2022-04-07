<?php
use App\View\Rodape;

$rodape = new Rodape();

$rodape->setScript('https://code.jquery.com/jquery-3.3.1.min.js', 'sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=');
$rodape->setScript('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', 'sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49');
$rodape->setScript('https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js', 'sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em');
$rodape->setScript('https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js');
$rodape->setScript('https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js');

$rodape->setScript('../assets/js/main.js');
$rodape->setScript('../assets/custom-js/data-format.js');
$rodape->setScript('../assets/custom-js/loading-automatico.js');