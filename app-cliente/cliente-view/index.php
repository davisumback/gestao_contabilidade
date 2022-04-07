<?php
session_start();

if(!array_key_exists('id_cliente', $_SESSION)){
    setcookie('permissao', 'true', time()+2, '/');
    setcookie('mensagem_permissao', 'Você precisa logar novamente', time()+2, '/');
    header("Location: ../index.php");
    die();
}

?>

<!DOCTYPE html>
<html lang="pr-br">
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	<meta name="description" content="">
    	<meta name="author" content="">
    	<link rel="icon" href="#">

        <title>Medb | Bem-vindo</title>

        <!-- Bootstrap core CSS -->

    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    	<!-- Custom styles for this template -->
    	<link href="../css/index-cliente.css" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700" rel="stylesheet">
    	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    </head>
    <body class="body">

        <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
           <a class="navbar-brand" href="#">
               <img src="../../sistema/images/logo_medb.png" width="70" height="20" alt="">
           </a>
           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
           </button>

           <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav mr-auto">
                   <li class="nav-item">
                       <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link" href="#">Exemplo 1</a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link" href="#">Exemplo 2</a>
                   </li>
               </ul>
               <ul class="navbar-nav navbar-right">
                   <li class="nav-item">
                       <a class="nav-link" href="../login/logout.php">Sair</a>
                   </li>
               </ul>

           </div>
       </nav>

        <div class="container mt-3">

            <div class="etapas">

                <!-- Stepper -->
                <div class="steps-form-2 scrollmenu scrollbar-primary pt-3">
                    <div class="steps-row-2 setup-panel-2 justify-content-between">
                        <div class="steps-step-2" id="botao1">
                            <div class="btn btn-circle-2 waves-effect">
                                <h6>Exemplo 1</h6>
                            </div>
                        </div>
                        <div class="linha"></div>
                        <div class="steps-step-2" id="botao2">
                            <h6 class="btn btn-circle-2 waves-effect ml-0">Exemplo 2</h6>
                        </div>
                        <div class="linha"></div>
                        <div class="steps-step-2" id="botao3">
                            <h6 class="btn btn-circle-2 waves-effect ml-0">Exemplo 3</h6>
                        </div>
                        <div class="linha"></div>
                        <div class="steps-step-2" id="botao4">
                            <h6 class="btn btn-circle-2 waves-effect ml-0">Exemplo 4</h6>
                        </div>

                    </div>
                </div>
            </div>


            <div class="mt-3">
                <!-- First Step -->
                <div class="row" id="step-1">
                    <div class="mb-5">
                        <h4 class="titulo-cliente-view text-center pl-0 my-4">TITULO EXEMPLO 1</h4>
                        <p class="etapas-texto ml-5 mr-5">Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica
                            e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor
                            desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de
                            modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também
                            ao salto para a editoração eletrônica, permanecendo essencialmente inalterado.
                            Se popularizou na década de 60, quando a Letraset lançou decalques contendo
                            passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a
                            softwares de editoração eletrônica como Aldus PageMaker.</p>
                        <p class="etapas-texto ml-5 mr-5">Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica
                            e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor
                            desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de
                            modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também
                            ao salto para a editoração eletrônica, permanecendo essencialmente inalterado.
                            Se popularizou na década de 60, quando a Letraset lançou decalques contendo
                            passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a
                            softwares de editoração eletrônica como Aldus PageMaker.
                        </p>
                    </div>
                </div>

                <!-- Second Step -->
                <div class="row setup-content-2" id="step-2" hidden>
                    <div class="mb-5">
                        <h4 class="titulo-cliente-view text-center pl-0 my-4">TITULO EXEMPLO 2</h4>
                        <p class="etapas-texto ml-5 mr-5">Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica
                            e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor
                            desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de
                            modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também
                            ao salto para a editoração eletrônica, permanecendo essencialmente inalterado.
                            Se popularizou na década de 60, quando a Letraset lançou decalques contendo
                            passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a
                            softwares de editoração eletrônica como Aldus PageMaker.</p>
                    </div>
                    <div class="card">
                        <img class="card-img-top" src="../../sistema/images/logo_medb.png" alt="Card image cap">
                        <div class="card-body mb-5">
                            <h6 class="card-title" align="center">Contrato</h6>
                            <p class="card-text text-center">Exemplo de card para download de arquivo.</p>
                            <div class="text-center">
                                <a href="#" class="btn btn-etapas">Download</a>
                            </div>
                      </div>
                    </div>
                </div>

                <!-- Third Step -->
                <div class="row setup-content-2" id="step-3" hidden>
                    <div class="col">
                        <h4 class="titulo-cliente-view text-center pl-0 my-4 mb-5">Comprovantes</h4>

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="card">
                                    <img class="card-img-top" src="../../sistema/images/logo_medb.png" alt="Card image cap">
                                    <div class="card-body mb-5">
                                        <h6 class="card-title" align="center">Contrato</h6>
                                        <p class="card-text text-center">Exemplo de card para download de arquivo.</p>
                                        <div class="text-center">
                                            <a href="#" class="btn btn-etapas text-center">Download</a>
                                        </div>
                                  </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="card">
                                    <img class="card-img-top" src="../../sistema/images/logo_medb.png" alt="Card image cap">
                                    <div class="card-body mb-5">
                                        <h6 class="card-title" align="center">Contrato</h6>
                                        <p class="card-text text-center">Exemplo de card para download de arquivo.</p>
                                        <div class="text-center">
                                            <a href="#" class="btn btn-etapas">Download</a>
                                        </div>
                                  </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="card">
                                    <img class="card-img-top" src="../../sistema/images/logo_medb.png" alt="Card image cap">
                                    <div class="card-body mb-5">
                                        <h6 class="card-title" align="center">Contrato</h6>
                                        <p class="card-text text-center">Exemplo de card para download de arquivo.</p>
                                        <div class="text-center">
                                            <a href="#" class="btn btn-etapas">Download</a>
                                            <a href="#" class="btn btn-etapas">Aceitar</a>
                                        </div>
                                  </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="card">
                                    <img class="card-img-top" src="../../sistema/images/logo_medb.png" alt="Card image cap">
                                    <div class="card-body mb-5">
                                        <h6 class="card-title" align="center">Contrato</h6>
                                        <p class="card-text text-center">Exemplo de card para download de arquivo.</p>
                                        <div class="text-center">
                                            <a href="#" class="btn btn-etapas">Download</a>
                                            <a href="#" class="btn btn-etapas">Aceitar</a>
                                        </div>
                                  </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Fourth Step -->
                <div id="step-4" hidden>
                    <div class="row setup-content-">
                        <div class="mb-5">
                            <h4 class="titulo-cliente-view text-center pl-0 my-4">TITULO EXEMPLO 4</h4>
                            <p class="etapas-texto ml-5 mr-5">Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica
                                e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor
                                desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de
                                modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também
                                ao salto para a editoração eletrônica, permanecendo essencialmente inalterado.
                                Se popularizou na década de 60, quando a Letraset lançou decalques contendo
                                passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a
                                softwares de editoração eletrônica como Aldus PageMaker.</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center mb-5">
                            <button type="button" class="btn btn-etapas btn-lg">Aceitar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">

            var step1 = document.getElementById("step-1");
            var step2 = document.getElementById("step-2");
            var step3 = document.getElementById("step-3");
            var step4 = document.getElementById("step-4");
            var botao1 = document.getElementById("botao1");
            var botao2 = document.getElementById("botao2");
            var botao3 = document.getElementById("botao3");
            var botao4 = document.getElementById("botao4");

            botao1.addEventListener("click", mostraTela1);
            botao2.addEventListener("click", mostraTela2);
            botao3.addEventListener("click", mostraTela3);
            botao4.addEventListener("click", mostraTela4);

            function mostraTela1(){
                if (botao1.click){
                    step1.removeAttribute("hidden");
                    step2.setAttribute("hidden", "true");
                    step3.setAttribute("hidden", "true");
                    step4.setAttribute("hidden", "true");
                }
            }

            function mostraTela2(){
                if (botao2.click){
                    step2.removeAttribute("hidden");
                    step1.setAttribute("hidden", "true");
                    step3.setAttribute("hidden", "true");
                    step4.setAttribute("hidden", "true");
                }
            }

            function mostraTela3(){
                if (botao1.click){
                    step3.removeAttribute("hidden");
                    step2.setAttribute("hidden", "true");
                    step1.setAttribute("hidden", "true");
                    step4.setAttribute("hidden", "true");
                }
            }

            function mostraTela4(){
                if (botao1.click){
                    step4.removeAttribute("hidden");
                    step2.setAttribute("hidden", "true");
                    step3.setAttribute("hidden", "true");
                    step1.setAttribute("hidden", "true");
                }
            }

        </script>

    </body>
</html>
