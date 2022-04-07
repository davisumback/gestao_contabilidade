<?php
use App\View\Rodape;

$rodape = new Rodape();

$rodape->setScript('https://code.jquery.com/jquery-3.3.1.slim.min.js', 'sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo');
$rodape->setScript('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', 'sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49');
$rodape->setScript('https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js', 'sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T');
$rodape->setScript('https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js');
$rodape->setScript('https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js');
// $rodape->setScript('https://cdn.ckeditor.com/ckeditor5/11.2.0/decoupled-document/ckeditor.js');
$rodape->setScript('../assets/js/main.js');
$rodape->setScript('../assets/custom-js/loading-automatico.js');
// $rodape->setScript('../assets/custom-js/alterar-botoes-menu.js');
// $rodape->setScript('../assets/custom-js/textarea-editor.js');
